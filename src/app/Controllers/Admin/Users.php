<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;
use CodeIgniter\Shield\Entities\User;

class Users extends BaseController
{
    public function index()
    {
        $users = model('UserModel')->orderBy('created_at', 'DESC')->paginate(15);

        return $this->adminView('users', [
            'pageTitle' => 'Users',
            'users'     => $users,
            'pager'     => model('UserModel')->pager,
        ]);
    }

    public function create()
    {
        return $this->adminView('user-add', [
            'pageTitle' => 'New User',
            'groups'    => setting('AuthGroups.groups'),
        ]);
    }

    public function store()
    {
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_dash|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'group'    => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = model('UserModel');
        $user  = new User([
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'active'   => $this->request->getPost('status'),
        ]);

        $users->save($user);

        $userId = $users->getInsertID();
        $user   = $users->find($userId);
        $user->addGroup($this->request->getPost('group'));

        $this->activityModel->log(
            auth()->id(),
            'user.created',
            'Created user ' . $this->request->getPost('email'),
            'users',
            $userId
        );

        return redirect()->to('/dashboard/users')->with('message', 'User created successfully.');
    }

    public function edit(int $id)
    {
        $user = model('UserModel')->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return $this->adminView('user-add', [
            'pageTitle'     => 'Edit User',
            'editUser'      => $user,
            'userGroups'    => $user->getGroups(),
            'groups'        => setting('AuthGroups.groups'),
        ]);
    }

    public function update(int $id)
    {
        $user = model('UserModel')->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $rules = [
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'username' => "required|alpha_dash|min_length[3]|is_unique[users.username,id,{$id}]",
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user->email    = $this->request->getPost('email');
        $user->username = $this->request->getPost('username');

        if ($this->request->getPost('password')) {
            $user->password = $this->request->getPost('password');
        }

        $status = $this->request->getPost('status');
        if ($status !== null) {
            $user->active = $status;
        }

        model('UserModel')->save($user);

        $group = $this->request->getPost('group');
        if ($group) {
            $user->syncGroups($group);
        }

        $this->activityModel->log(
            auth()->id(),
            'user.updated',
            'Updated user ' . $user->email,
            'users',
            $id
        );

        return redirect()->to('/dashboard/users')->with('message', 'User updated successfully.');
    }

    public function delete(int $id)
    {
        $user = model('UserModel')->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        model('UserModel')->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'user.deleted',
            'Deleted user ' . $user->email,
            'users',
            $id
        );

        return redirect()->to('/dashboard/users')->with('message', 'User deleted successfully.');
    }
}
