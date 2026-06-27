<?php
namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ActivityModel;
use App\Models\ConfigurationModel;

class MessageController extends BaseController
{
    protected $messageModel;
    protected $activityModel;
    protected $configModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        $this->activityModel = new ActivityModel();
        $this->configModel = new ConfigurationModel();
    }

    public function index()
    {
        $configList = $this->configModel->getAllConfigs();

        $data = [
            'title' => 'Message Management',
            'date_format' => $configList['date_format'],
            'paginate_rows' => $configList['paginate_rows'],
        ];

        $data['content'] = view('message/index', $data);
        return view('dashboard/master', $data);
    }

    public function list()
    {
        $configList = $this->configModel->getAllConfigs();

        $perPage = (int) $configList['paginate_rows'];
        $page = $this->request->getGet('page') ?? 1;
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $builder = $this->messageModel->where('deleted_at', null);

        if (!empty($startDate)) {
            $builder->where('created_at >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('created_at <=', $endDate . ' 23:59:59');
        }

        $offset = ($page - 1) * $perPage;
        $messages = $builder->orderBy('created_at', 'DESC')
            ->limit($perPage, $offset)
            ->findAll();

        $totalRecords = $this->messageModel->countAll();

        $filteredBuilder = clone $builder;
        $filteredCount = $filteredBuilder->countAllResults(false);

        foreach ($messages as $i => $row) {
            $messages[$i]['created_at'] = date($configList['date_format'], strtotime($row['created_at']));
        }

        $hasMore = ($offset + $perPage) < $filteredCount;

        return $this->response->setJSON([
            'success' => true,
            'data' => $messages,
            'total_records' => $totalRecords,
            'filtered_count' => $filteredCount,
            'has_more' => $hasMore,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update($id)
    {
        $data = [
            'status' => $this->request->getPost('status')
        ];

        if (!$this->messageModel->update($id, $data)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $this->messageModel->errors(),
                    'csrf_token' => csrf_hash()
                ]);
        }

        try {
            $updatedMessage = $this->messageModel->find($id);

            $this->activityModel->logActivity('warning', $updatedMessage['subject'] . ' Message Updated');

            return $this->response->setJSON([
                'success' => true,
                'message' => $updatedMessage,
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to update message',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $message = $this->messageModel->find($id);
            if (!$message) {
                return $this->response->setStatusCode(404)->setJSON([
                    'success' => false,
                    'message' => 'Message not found',
                    'csrf_token' => csrf_hash()
                ]);
            }

            $this->messageModel->delete($id);

            $this->activityModel->logActivity('warning', $message['subject'] . ' Message Deleted');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Message deleted successfully',
                'csrf_token' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'error' => 'Failed to delete message',
                'csrf_token' => csrf_hash()
            ]);
        }
    }
}