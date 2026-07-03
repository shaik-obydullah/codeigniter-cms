<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <?= view('admin/layout/sidebar', ['currentPage' => 'comments']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <button class="px-3 py-1.5 rounded-lg bg-lime-500 text-gray-900 text-sm font-medium">All</button>
                    <button class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700">Pending</button>
                    <button class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700">Approved</button>
                    <button class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700">Spam</button>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="divide-y divide-gray-700">
                        <?php foreach ($comments as $comment): ?>
                        <div class="p-5 hover:bg-gray-700/30 transition">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center text-sm font-medium text-blue-400"><?= strtoupper(substr($comment->author_name, 0, 2)) ?></div>
                                    <div>
                                        <p class="text-sm text-white font-medium"><?= esc($comment->author_name) ?></p>
                                        <p class="text-xs text-gray-500"><?= esc($comment->author_email) ?></p>
                                    </div>
                                </div>
                                <?php $statusColors = ['pending' => 'bg-yellow-500/10 text-yellow-400', 'approved' => 'bg-green-500/10 text-green-400', 'spam' => 'bg-red-500/10 text-red-400']; ?>
                                <span class="px-2 py-0.5 rounded text-xs <?= $statusColors[$comment->status] ?? 'bg-gray-500/10 text-gray-400' ?> shrink-0"><?= esc(ucfirst($comment->status)) ?></span>
                            </div>
                            <p class="text-sm text-gray-300 mb-2"><?= esc($comment->content) ?></p>
                            <div class="flex items-center justify-between">
                                <a href="<?= site_url('/articles/' . $comment->article_id) ?>" class="text-xs text-lime-500 hover:text-lime-400 transition">on <?= esc($comment->article_title) ?></a>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-600"><?= time_elapsed_string($comment->created_at) ?></span>
                                    <?php if ($comment->status === 'pending'): ?>
                                    <form method="post" action="<?= site_url('/dashboard/comments/' . $comment->id . '/approve') ?>" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1 text-gray-500 hover:text-green-400 transition" title="Approve"><i class="fas fa-check text-xs"></i></button>
                                    </form>
                                    <?php endif; ?>
                                    <form method="post" action="<?= site_url('/dashboard/comments/' . $comment->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1 text-gray-500 hover:text-red-400 transition" title="Delete"><i class="fas fa-trash text-xs"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="px-5 py-3 border-t border-gray-700 flex items-center justify-between">
                        <p class="text-sm text-gray-500"><?= $pager ? $pager->getTotal() . ' total' : '' ?></p>
                        <?php if ($pager): ?><?= $pager->links() ?><?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
