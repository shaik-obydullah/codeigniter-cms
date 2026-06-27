<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ActivityModel;

class LoginController extends BaseController
{
    protected $adminModel;
    protected $activityModel;
    protected $session;
    protected $throttler;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->activityModel = new ActivityModel();
        $this->session = service('session');
        $this->throttler = service('throttler');
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('/dashboard');
        }

        $locked = $this->session->get('locked');
        if ($locked) {
            $this->handleLockedSession($locked);
            return view('dashboard/login', ['title' => 'Login', 'locked' => true]);
        }

        return view('dashboard/login', ['title' => 'Login']);
    }

    public function auth()
    {
        if ($this->session->get('locked')) {
            $this->handleLockedSession($this->session->get('locked'));
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Account locked. Please try again later.',
                'locked' => true
            ]);
        }

        if ($this->throttler->check($this->request->getIPAddress(), 5, MINUTE * 5) === false) {
            return $this->response->setStatusCode(429)->setJSON([
                'success' => false,
                'message' => 'Too many requests. Please try again in ' . $this->throttler->getTokenTime() . ' seconds.',
            ]);
        }

        $data = $this->request->getJSON(true);

        $validationData = [
            'user_name' => $data['user_name'] ?? null,
            'password' => $data['password'] ?? null,
        ];

        $rules = [
            'user_name' => [
                'label' => 'Username',
                'rules' => 'required|trim|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'min_length' => 'The {field} must be at least {param} characters.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|trim|min_length[8]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->validator->getErrors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $username = $validationData['user_name'];
        $password = $validationData['password'];

        $admin = $this->adminModel->verifyCredentials($username, $password);

        if (!$admin) {
            $this->activityModel->logActivity('warning', 'Admin Login Failed');

            $attempts = $this->session->get('login_attempt') ?? 0;
            $this->session->set('login_attempt', $attempts + 1);

            if ($attempts >= 2) {
                $this->activityModel->logActivity('warning', 'Admin Login Locked');
                $this->session->set('locked', time());
                $this->activityModel->logSecurityEvent(
                    'Account locked',
                    "Username: $username",
                    ['ip' => service('request')->getIPAddress()]
                );

                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Account locked due to too many failed attempts. Please try again later.',
                    'locked' => true
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid Credentials',
                'attempts_remaining' => 2 - $attempts
            ]);
        }

        $this->session->remove('login_attempt');

        $this->createUserSession($admin);
        $this->activityModel->logActivity('success', 'Admin Login Success', $admin['id']);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login Successful',
            'redirect' => '/dashboard',
        ]);
    }

    protected function handleLockedSession($lockedTime)
    {
        if (time() - $lockedTime > 300) {
            $this->session->remove('locked');
            $this->session->remove('login_attempt');
            return;
        }

        $this->activityModel->logSecurityEvent(
            'Locked session access attempt',
            'User tried to access locked session'
        );
    }

    public function logout()
    {
        if ($this->session->has('id')) {
            $this->activityModel->logActivity('warning', 'User Logged Out', $this->session->get('id'));
        }
        $this->session->destroy();
        return redirect()->to('/login');
    }

    protected function isLoggedIn()
    {
        return $this->session->has('logged_in') && $this->session->get('logged_in') === true;
    }

    protected function createUserSession(array $admin)
    {
        $sessionData = [
            'id' => $admin['id'],
            'user_name' => $admin['user_name'],
            'first_name' => $admin['first_name'],
            'email' => $admin['email'],
            'logged_in' => true
        ];
        $this->session->set($sessionData);
        $this->session->remove(['login_attempt', 'locked']);
    }
}