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
                <?php if (session('errors')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= implode('<br>', session('errors')) ?></div>
                <?php endif; ?>

                <div class="flex items-center gap-2 text-sm text-gray-500 mb-5">
                    <a href="<?= site_url('/dashboard/users') ?>" class="hover:text-lime-400 transition">Users</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-gray-300"><?= isset($editUser) ? 'Edit User' : 'New User' ?></span>
                </div>

                <form method="post" action="<?= site_url('/dashboard/users' . (isset($editUser) ? '/' . $editUser->id : '')) ?>" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <?= csrf_field() ?>
                    <?php if (isset($editUser)): ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-4">Account Information</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-300 mb-1.5">Username</label>
                                    <input type="text" id="username" name="username" value="<?= old('username', $editUser->username ?? '') ?>"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                                    <input type="email" id="email" name="email" value="<?= old('email', $editUser->email ?? '') ?>"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-4">Password</h3>
                            <p class="text-xs text-gray-500 mb-3"><?= isset($editUser) ? 'Leave blank to keep current password.' : 'Set a strong password for the new account.' ?></p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label for="password_confirm" class="block text-sm font-medium text-gray-300 mb-1.5">Confirm Password</label>
                                    <input type="password" id="password_confirm" name="password_confirm"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Status</h3>
                            <select name="status"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                <option value="1" <?= (old('status', $editUser->active ?? '1') == '1') ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= (old('status', $editUser->active ?? '1') == '0') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Role</h3>
                            <div class="space-y-3">
                                <?php foreach ($groups as $group => $info): ?>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="group" value="<?= $group ?>"
                                        <?= (old('group') ? old('group') === $group : (isset($userGroups) && in_array($group, $userGroups) ?: !isset($editUser) && $group === 'user')) ? 'checked' : '' ?>
                                        class="w-4 h-4 bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                    <div><p class="text-sm text-white"><?= esc($info['title'] ?? $group) ?></p><p class="text-xs text-gray-500"><?= esc($info['description'] ?? '') ?></p></div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save</button>
                            <a href="<?= site_url('/dashboard/users') ?>" class="flex-1 bg-gray-700 text-gray-300 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm text-center">Cancel</a>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>
</html>
