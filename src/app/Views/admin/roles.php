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
        <?= view('admin/layout/sidebar', ['currentPage' => 'roles']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6 space-y-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('/admin/roles') ?>">
                    <?= csrf_field() ?>

                    <?php foreach ($groups as $group => $info): ?>
                    <div class="bg-gray-800 rounded-xl border border-gray-700 divide-y divide-gray-700 mb-6">
                        <div class="p-5 flex items-center justify-between">
                            <div>
                                <h3 class="text-white font-semibold text-sm"><?= esc($info['title'] ?? $group) ?></h3>
                                <p class="text-xs text-gray-500 mt-0.5"><?= esc($info['description'] ?? '') ?></p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded text-xs font-medium bg-blue-500/10 text-blue-400"><?= ($groupCounts[$group] ?? 0) ?> users</span>
                        </div>
                        <div class="p-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                            <?php foreach ($permissions as $perm => $permDesc): ?>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" name="matrix[<?= $group ?>][]" value="<?= $perm ?>"
                                        <?= (isset($matrix[$group]) && in_array($perm, $matrix[$group])) ? 'checked' : '' ?>
                                        class="sr-only peer" />
                                    <div class="w-9 h-4.5 bg-gray-700 rounded-full peer-checked:bg-lime-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-3.5 after:h-3.5 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-4.5"></div>
                                </div>
                                <span class="text-sm text-gray-300"><?= esc($permDesc) ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save Permissions</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>
</html>
