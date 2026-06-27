<?php
namespace App\Controllers;

use App\Models\WalletModel;
use App\Models\ActivityModel;

class WalletController extends BaseController
{
    protected $walletModel;
    protected $activityModel;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->activityModel = new ActivityModel();
    }

    public function index()
    {
        $data = [
            'title' => 'My Wallets',
            'wallets' => $this->walletModel->findAll()
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['wallets']);
        }

        $data['content'] = view('wallet/index', $data);
        return view('dashboard/master', $data);
    }

    public function create()
    {
        $name = trim($this->request->getPost('name'));
        $existingWallet = $this->walletModel->where('name', $name)->first();

        if ($existingWallet) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['name' => 'This wallet name already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [
            'name' => $name,
            'category' => $this->request->getPost('category')
        ];

        if (!$this->walletModel->insert($data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->walletModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        $newWallet = $this->walletModel->find($this->walletModel->getInsertID());

        $this->activityModel->logActivity('success', $data['name'] . ' Wallet Created');

        return $this->response->setJSON([
            'success' => true,
            'wallet' => $newWallet,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update($id)
    {
        $name = trim($this->request->getPost('name'));
        $existingWallet = $this->walletModel->where('name', $name)->where('id !=', $id)->first();

        if ($existingWallet) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => ['name' => 'This wallet name already exists'],
                    'csrf_token' => csrf_hash()
                ]);
        }

        $data = [
            'name' => $name,
            'category' => $this->request->getPost('category')
        ];

        if (!$this->walletModel->update($id, $data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->walletModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        try {
            $updatedWallet = $this->walletModel->find($id);

            $this->activityModel->logActivity('warning', $updatedWallet['name'] . ' Wallet Updated');

            return $this->response->setJSON([
                'success' => true,
                'wallet' => $updatedWallet,
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to update wallet',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $wallet = $this->walletModel->find($id);
            if (!$wallet) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Wallet not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->walletModel->delete($id);

            $this->activityModel->logActivity('warning', $wallet['name'] . ' Wallet Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Wallet deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to delete wallet',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}