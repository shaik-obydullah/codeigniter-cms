<?php

namespace App\Controllers\Admin;

use App\Models\MediaModel;

class Media extends BaseController
{
    public function index()
    {
        $search = $this->request->getGet('search');
        $model  = model(MediaModel::class);

        if ($search) {
            $model->like('original_name', $search);
        }

        $items = $model->orderBy('created_at', 'DESC')->findAll();

        return $this->adminView('media', [
            'pageTitle' => 'Media Library',
            'mediaItems' => $items,
            'search'     => $search,
        ]);
    }

    public function upload()
    {
        $files = $this->request->getFiles();

        if (!$files || !isset($files['files'])) {
            return redirect()->back()->with('error', 'No files selected.');
        }

        $uploaded = 0;

        foreach ($files['files'] as $file) {
            if (!$file->isValid() || $file->hasMoved()) {
                continue;
            }

            $mimeType = $file->getMimeType();
            if (!str_starts_with($mimeType, 'image/')) {
                continue;
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/media', $newName);

            model(MediaModel::class)->insert([
                'user_id'       => auth()->id(),
                'filename'      => $newName,
                'original_name' => $file->getClientName(),
                'path'          => 'uploads/media/' . $newName,
                'type'          => $mimeType,
                'size'          => $file->getSize(),
            ]);

            $uploaded++;
        }

        if ($uploaded > 0) {
            return redirect()->to('/dashboard/media')->with('message', $uploaded . ' file(s) uploaded.');
        }

        return redirect()->back()->with('error', 'No valid image files uploaded.');
    }

    public function delete(int $id)
    {
        $model = model(MediaModel::class);
        $item  = $model->find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $path = FCPATH . $item->path;
        if (file_exists($path)) {
            unlink($path);
        }

        $model->delete($id);

        return redirect()->to('/dashboard/media')->with('message', 'File deleted.');
    }

    public function browse()
    {
        $model = model(MediaModel::class);
        $items = $model->orderBy('created_at', 'DESC')->findAll();

        $data = array_map(function ($item) {
            return [
                'id'   => $item->id,
                'url'  => base_url($item->path),
                'name' => $item->original_name,
                'type' => $item->type,
            ];
        }, $items);

        return $this->response->setJSON($data);
    }
}
