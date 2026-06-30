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
        <?= view('admin/layout/sidebar', ['currentPage' => 'skills']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>
                <?php if (session('errors')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= implode('<br>', session('errors')) ?></div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-search text-sm"></i></span>
                        <input type="text" placeholder="Search skills..."
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <?php foreach ($skills as $skill): ?>
                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 flex items-start gap-4 group hover:border-lime-500/30 transition">
                        <div class="w-12 h-12 bg-lime-500/10 rounded-lg flex items-center justify-center text-xl text-lime-400 shrink-0"><i class="<?= esc($skill->icon ?? 'fas fa-code') ?>"></i></div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-white font-medium text-sm"><?= esc($skill->name) ?></h4>
                                    <p class="text-xs text-gray-400 mt-0.5 line-clamp-2"><?= esc($skill->description ?? '') ?></p>
                                </div>
                                <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition shrink-0">
                                    <a href="<?= site_url('/admin/skills/' . $skill->id . '/edit') ?>" class="p-1.5 text-gray-500 hover:text-lime-400 rounded-lg hover:bg-gray-700 transition" title="Edit"><i class="fas fa-pen text-xs"></i></a>
                                    <form method="post" action="<?= site_url('/admin/skills/' . $skill->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 rounded-lg hover:bg-gray-700 transition" title="Delete"><i class="fas fa-trash text-xs"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($pager): ?>
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-gray-500"><?= $pager->getTotal() ?> total</p>
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>

                <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                    <h3 class="text-white font-semibold text-sm mb-4">Add New Skill</h3>
                    <form method="post" action="<?= site_url('/admin/skills') ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?= csrf_field() ?>
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-300 mb-1.5">Icon</label>
                            <input type="text" id="icon" name="icon" placeholder="fab fa-laravel"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            <p class="text-xs text-gray-500 mt-1">e.g. <code class="text-lime-400">fab fa-laravel</code>, <code class="text-lime-400">fas fa-database</code></p>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                            <input type="text" id="name" name="name" placeholder="Laravel"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                            <textarea id="description" name="description" rows="1" placeholder="PHP framework for web artisans..."
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"></textarea>
                        </div>
                        <div class="md:col-span-3 flex items-center gap-3 pt-2">
                            <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save Skill</button>
                            <button type="reset" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Reset</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
