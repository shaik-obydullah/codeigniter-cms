<?php

namespace App\Controllers\Admin;

use App\Models\CommentModel;

class Comments extends BaseController
{
    public function index()
    {
        $commentModel = model(CommentModel::class);
        $status       = $this->request->getGet('status');

        if ($status && !in_array($status, ['pending', 'approved', 'spam'])) {
            $status = null;
        }

        $comments = $commentModel->getPaginatedComments($status, 20);

        $pager = $commentModel->pager;
        $pager->only(['status']);

        return $this->adminView('comments', [
            'pageTitle' => 'Comments',
            'comments'  => $comments,
            'pager'     => $pager,
            'status'    => $status,
        ]);
    }

    public function approve(int $id)
    {
        $comment = model(CommentModel::class)->find($id);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        model(CommentModel::class)->update($id, ['status' => 'approved']);

        $this->activityModel->log(
            auth()->id(),
            'comment.approved',
            'Approved comment #' . $id,
            'comments',
            $id
        );

        return redirect()->to('/dashboard/comments')->with('message', 'Comment approved.');
    }

    public function delete(int $id)
    {
        $comment = model(CommentModel::class)->find($id);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        model(CommentModel::class)->delete($id);

        $this->activityModel->log(
            auth()->id(),
            'comment.deleted',
            'Deleted comment #' . $id,
            'comments',
            $id
        );

        return redirect()->to('/dashboard/comments')->with('message', 'Comment deleted successfully.');
    }
}
