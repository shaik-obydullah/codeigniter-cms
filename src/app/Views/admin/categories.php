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
        <?= view('admin/layout/sidebar', ['currentPage' => 'categories']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-search text-sm"></i></span>
                        <input type="text" placeholder="Search categories..."
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($categories as $category): ?>
                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 hover:border-lime-500/50 transition group">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-600/30 rounded-lg flex items-center justify-center">
                                    <i class="<?= esc($category->icon ?? 'fas fa-folder') ?> text-gray-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium text-sm"><?= esc($category->name) ?></h3>
                                    <p class="text-xs text-gray-500"><?= (int) ($category->article_count ?? 0) ?> articles</p>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <a href="<?= site_url('/admin/categories/' . $category->id . '/edit') ?>" class="p-1.5 text-gray-500 hover:text-white hover:bg-gray-700 rounded-lg transition" title="Edit"><i class="fas fa-pen text-xs"></i></a>
                                <form method="post" action="<?= site_url('/admin/categories/' . $category->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 hover:bg-gray-700 rounded-lg transition" title="Delete"><i class="fas fa-trash text-xs"></i></button>
                                </form>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500"><?= esc($category->description ?? '') ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($pager): ?>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-sm text-gray-500"><?= $pager->getTotal() ?> total</p>
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>

                <div class="mt-6 bg-gray-800 rounded-xl border border-gray-700 p-5">
                    <h3 class="text-white font-semibold text-sm mb-4">Add New Category</h3>
                    <form method="post" action="<?= site_url('/admin/categories') ?>">
                        <?= csrf_field() ?>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <input type="text" name="name" placeholder="Category name"
                                class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            <textarea name="description" placeholder="Description (optional)" rows="1"
                                class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"></textarea>
                            <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm shrink-0">Create</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
