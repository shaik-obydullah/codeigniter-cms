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
        <?= view('admin/layout/sidebar', ['currentPage' => 'dashboard']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-400 text-sm font-medium">Total Users</span>
                            <span class="w-9 h-9 bg-blue-500/10 rounded-lg flex items-center justify-center"><i class="fas fa-users text-blue-400 text-sm"></i></span>
                        </div>
                        <p class="text-2xl font-bold text-white"><?= $totalUsers ?? 0 ?></p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-400 text-sm font-medium">Articles</span>
                            <span class="w-9 h-9 bg-lime-500/10 rounded-lg flex items-center justify-center"><i class="fas fa-newspaper text-lime-400 text-sm"></i></span>
                        </div>
                        <p class="text-2xl font-bold text-white"><?= $totalArticles ?? 0 ?></p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-400 text-sm font-medium">Projects</span>
                            <span class="w-9 h-9 bg-purple-500/10 rounded-lg flex items-center justify-center"><i class="fas fa-diagram-project text-purple-400 text-sm"></i></span>
                        </div>
                        <p class="text-2xl font-bold text-white"><?= $totalProjects ?? 0 ?></p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-400 text-sm font-medium">Skills</span>
                            <span class="w-9 h-9 bg-cyan-500/10 rounded-lg flex items-center justify-center"><i class="fas fa-code text-cyan-400 text-sm"></i></span>
                        </div>
                        <p class="text-2xl font-bold text-white"><?= $totalSkills ?? 0 ?></p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-400 text-sm font-medium">Comments</span>
                            <span class="w-9 h-9 bg-amber-500/10 rounded-lg flex items-center justify-center"><i class="fas fa-comments text-amber-400 text-sm"></i></span>
                        </div>
                        <p class="text-2xl font-bold text-white"><?= $pendingComments ?? 0 ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-gray-800 rounded-xl border border-gray-700">
                        <div class="px-5 py-4 border-b border-gray-700 flex items-center justify-between">
                            <h3 class="text-white font-semibold">Recent Activity</h3>
                            <a href="<?= site_url('/admin/activities') ?>" class="text-lime-500 text-sm hover:text-lime-400 transition">View All</a>
                        </div>
                        <div class="divide-y divide-gray-700">
                            <?php if (!empty($recentActivity)): ?>
                                <?php foreach ($recentActivity as $activity): ?>
                                    <div class="px-5 py-3.5 flex items-center gap-3">
                                        <div class="w-8 h-8 bg-lime-500/10 rounded-full flex items-center justify-center shrink-0"><i class="fas fa-circle text-lime-400 text-xs"></i></div>
                                        <div class="min-w-0"><p class="text-sm text-white truncate"><?= esc($activity->description) ?></p><p class="text-xs text-gray-500"><?= time_elapsed_string($activity->created_at) ?></p></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="px-5 py-8 text-center text-gray-500 text-sm">No recent activity.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-xl border border-gray-700">
                        <div class="px-5 py-4 border-b border-gray-700"><h3 class="text-white font-semibold">Quick Actions</h3></div>
                        <div class="p-5 space-y-3">
                            <a href="<?= site_url('/admin/articles/create') ?>" class="flex items-center gap-3 px-4 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition"><i class="fas fa-plus text-lime-400 text-sm w-5 text-center"></i><span class="text-sm text-white">New Article</span></a>
                            <a href="<?= site_url('/admin/projects/create') ?>" class="flex items-center gap-3 px-4 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition"><i class="fas fa-plus text-blue-400 text-sm w-5 text-center"></i><span class="text-sm text-white">New Project</span></a>
                            <a href="<?= site_url('/admin/users/create') ?>" class="flex items-center gap-3 px-4 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition"><i class="fas fa-user-plus text-purple-400 text-sm w-5 text-center"></i><span class="text-sm text-white">Add User</span></a>
                            <a href="<?= site_url('/admin/site-settings') ?>" class="flex items-center gap-3 px-4 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition"><i class="fas fa-gear text-amber-400 text-sm w-5 text-center"></i><span class="text-sm text-white">Site Settings</span></a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
