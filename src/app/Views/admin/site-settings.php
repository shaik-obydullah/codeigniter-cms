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
        <?= view('admin/layout/sidebar', ['currentPage' => 'site-settings']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('/dashboard/site-settings') ?>" class="max-w-3xl space-y-6">
                    <?= csrf_field() ?>

                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                        <h3 class="text-white font-semibold text-sm mb-4">General</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-300 mb-1.5">Site Name</label>
                                <input type="text" id="site_name" name="site_name" value="<?= old('site_name', $settings['site_name'] ?? '') ?>"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                            </div>
                            <div>
                                <label for="site_tagline" class="block text-sm font-medium text-gray-300 mb-1.5">Tagline</label>
                                <input type="text" id="site_tagline" name="site_tagline" value="<?= old('site_tagline', $settings['site_tagline'] ?? '') ?>"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                            </div>
                            <div>
                                <label for="site_email" class="block text-sm font-medium text-gray-300 mb-1.5">Contact Email</label>
                                <input type="email" id="site_email" name="site_email" value="<?= old('site_email', $settings['site_email'] ?? '') ?>"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                            </div>
                            <div>
                                <label for="site_description" class="block text-sm font-medium text-gray-300 mb-1.5">Site Description</label>
                                <textarea id="site_description" name="site_description" rows="3"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent resize-none"><?= old('site_description', $settings['site_description'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                        <h3 class="text-white font-semibold text-sm mb-4">Social Links</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 text-gray-500 text-center"><i class="fab fa-github"></i></span>
                                <input type="url" name="github_url" value="<?= old('github_url', $settings['github_url'] ?? '') ?>" placeholder="https://github.com/username"
                                    class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-8 text-gray-500 text-center"><i class="fab fa-linkedin-in"></i></span>
                                <input type="url" name="linkedin_url" value="<?= old('linkedin_url', $settings['linkedin_url'] ?? '') ?>" placeholder="https://linkedin.com/in/username"
                                    class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-8 text-gray-500 text-center"><i class="fab fa-twitter"></i></span>
                                <input type="url" name="twitter_url" value="<?= old('twitter_url', $settings['twitter_url'] ?? '') ?>" placeholder="https://twitter.com/username"
                                    class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-8 text-gray-500 text-center"><i class="fab fa-youtube"></i></span>
                                <input type="url" name="youtube_url" value="<?= old('youtube_url', $settings['youtube_url'] ?? '') ?>" placeholder="https://youtube.com/@channel"
                                    class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                        <h3 class="text-white font-semibold text-sm mb-4">Appearance</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-300 mb-1.5 block">Theme Mode</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="theme_mode" value="dark" <?= (old('theme_mode', $settings['theme_mode'] ?? 'dark') == 'dark') ? 'checked' : '' ?>
                                            class="w-4 h-4 bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                        <span class="text-sm text-gray-300">Dark</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="theme_mode" value="light" <?= (old('theme_mode', $settings['theme_mode'] ?? 'dark') == 'light') ? 'checked' : '' ?>
                                            class="w-4 h-4 bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                        <span class="text-sm text-gray-300">Light</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="theme_mode" value="auto" <?= (old('theme_mode', $settings['theme_mode'] ?? 'dark') == 'auto') ? 'checked' : '' ?>
                                            class="w-4 h-4 bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                        <span class="text-sm text-gray-300">Auto</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="items_per_page" class="block text-sm font-medium text-gray-300 mb-1.5">Items Per Page</label>
                                <select id="items_per_page" name="items_per_page"
                                    class="w-full sm:w-48 bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                    <option value="10" <?= (old('items_per_page', $settings['items_per_page'] ?? '15') == '10') ? 'selected' : '' ?>>10</option>
                                    <option value="15" <?= (old('items_per_page', $settings['items_per_page'] ?? '15') == '15') ? 'selected' : '' ?>>15</option>
                                    <option value="25" <?= (old('items_per_page', $settings['items_per_page'] ?? '15') == '25') ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= (old('items_per_page', $settings['items_per_page'] ?? '15') == '50') ? 'selected' : '' ?>>50</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                        <h3 class="text-white font-semibold text-sm mb-4">Maintenance</h3>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div>
                                    <p class="text-sm text-gray-300">Maintenance Mode</p>
                                    <p class="text-xs text-gray-500">When enabled, only admins can access the site.</p>
                                </div>
                                <div class="relative">
                                    <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer" <?= ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' ?> />
                                    <div class="w-10 h-5 bg-gray-700 rounded-full peer-checked:bg-lime-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-4 after:h-4 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-5"></div>
                                </div>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div>
                                    <p class="text-sm text-gray-300">Allow Registration</p>
                                    <p class="text-xs text-gray-500">Allow new users to register on the site.</p>
                                </div>
                                <div class="relative">
                                    <input type="checkbox" name="allow_registration" value="1" class="sr-only peer" <?= ($settings['allow_registration'] ?? '1') == '1' ? 'checked' : '' ?> />
                                    <div class="w-10 h-5 bg-gray-700 rounded-full peer-checked:bg-lime-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-4 after:h-4 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-5"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save Settings</button>
                        <button type="reset" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Reset</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>
</html>
