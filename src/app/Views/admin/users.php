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
        <?= view('admin/layout/sidebar', ['currentPage' => 'users']) ?>

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
                        <input type="text" placeholder="Search users..." class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                    <a href="<?= site_url('/dashboard/users/create') ?>" class="flex items-center gap-2 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm shrink-0"><i class="fas fa-plus"></i> New User</a>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-700 bg-gray-800/50">
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">User</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Role</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Status</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Joined</th>
                                    <th class="text-right px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <?php foreach ($users as $userItem): ?>
                                <tr class="hover:bg-gray-700/50 transition">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-xs font-medium text-white"><?= strtoupper(substr($userItem->username ?? $userItem->email, 0, 2)) ?></div>
                                            <div><p class="text-white font-medium"><?= esc($userItem->username ?? 'N/A') ?></p><p class="text-gray-500 text-xs"><?= esc($userItem->email) ?></p></div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <?php $groups = $userItem->getGroups(); ?>
                                        <?php if (!empty($groups)): ?>
                                            <?php foreach ($groups as $group): ?>
                                                <span class="px-2.5 py-1 rounded text-xs font-medium <?= $group === 'superadmin' ? 'bg-purple-500/10 text-purple-400' : ($group === 'admin' ? 'bg-blue-500/10 text-blue-400' : ($group === 'developer' ? 'bg-cyan-500/10 text-cyan-400' : ($group === 'beta' ? 'bg-orange-500/10 text-orange-400' : 'bg-green-500/10 text-green-400'))) ?>"><?= esc($group) ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-gray-600">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2.5 py-1 rounded text-xs font-medium <?= $userItem->active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' ?>"><?= $userItem->active ? 'Active' : 'Inactive' ?></span>
                                    </td>
                                    <td class="px-5 py-4 text-gray-400 whitespace-nowrap"><?= $userItem->created_at ? date('M j, Y', strtotime($userItem->created_at)) : '—' ?></td>
                                    <td class="px-5 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="<?= site_url('/dashboard/users/' . $userItem->id . '/edit') ?>" class="p-1.5 text-gray-500 hover:text-white hover:bg-gray-700 rounded-lg transition" title="Edit"><i class="fas fa-pen text-sm"></i></a>
                                            <form method="post" action="<?= site_url('/dashboard/users/' . $userItem->id . '/delete') ?>" onsubmit="return confirm('Delete this user?')" class="inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 hover:bg-gray-700 rounded-lg transition" title="Delete"><i class="fas fa-trash text-sm"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
