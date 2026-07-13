<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'site-settings', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('/dashboard/site-settings') ?>" class="max-w-5xl">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
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
                                        <input type="url" name="github_url" value="<?= old('github_url', $settings['github'] ?? '') ?>" placeholder="https://github.com/username"
                                            class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="w-8 text-gray-500 text-center"><i class="fab fa-linkedin-in"></i></span>
                                        <input type="url" name="linkedin_url" value="<?= old('linkedin_url', $settings['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/in/username"
                                            class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="w-8 text-gray-500 text-center"><i class="fab fa-twitter"></i></span>
                                        <input type="url" name="twitter_url" value="<?= old('twitter_url', $settings['twitter'] ?? '') ?>" placeholder="https://twitter.com/username"
                                            class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="w-8 text-gray-500 text-center"><i class="fab fa-youtube"></i></span>
                                        <input type="url" name="youtube_url" value="<?= old('youtube_url', $settings['youtube'] ?? '') ?>" placeholder="https://youtube.com/@channel"
                                            class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                                <h3 class="text-white font-semibold text-sm mb-4">Appearance</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-300 mb-1.5 block">Theme Mode</label>
                                        <div class="flex flex-col gap-2">
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
                                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
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

                            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                                <h3 class="text-white font-semibold text-sm mb-4">Localization</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="time_format" class="block text-sm font-medium text-gray-300 mb-1.5">Time Format</label>
                                        <select id="time_format" name="time_format"
                                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                            <option value="H:i" <?= (old('time_format', $settings['time_format'] ?? 'H:i') == 'H:i') ? 'selected' : '' ?>>24-hour (14:30)</option>
                                            <option value="h:i A" <?= (old('time_format', $settings['time_format'] ?? 'H:i') == 'h:i A') ? 'selected' : '' ?>>12-hour (02:30 PM)</option>
                                            <option value="h:i a" <?= (old('time_format', $settings['time_format'] ?? 'H:i') == 'h:i a') ? 'selected' : '' ?>>12-hour (02:30 pm)</option>
                                            <option value="g:i A" <?= (old('time_format', $settings['time_format'] ?? 'H:i') == 'g:i A') ? 'selected' : '' ?>>12-hour (2:30 PM)</option>
                                            <option value="H:i:s" <?= (old('time_format', $settings['time_format'] ?? 'H:i') == 'H:i:s') ? 'selected' : '' ?>>24-hour with seconds (14:30:00)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="date_format" class="block text-sm font-medium text-gray-300 mb-1.5">Date Format</label>
                                        <select id="date_format" name="date_format"
                                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                            <option value="M j, Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'M j, Y') ? 'selected' : '' ?>>Jan 15, 2025</option>
                                            <option value="F j, Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'F j, Y') ? 'selected' : '' ?>>January 15, 2025</option>
                                            <option value="Y-m-d" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'Y-m-d') ? 'selected' : '' ?>>2025-01-15</option>
                                            <option value="d/m/Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'd/m/Y') ? 'selected' : '' ?>>15/01/2025</option>
                                            <option value="m/d/Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'm/d/Y') ? 'selected' : '' ?>>01/15/2025</option>
                                            <option value="d F, Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'd F, Y') ? 'selected' : '' ?>>15 January, 2025</option>
                                            <option value="j M, Y" <?= (old('date_format', $settings['date_format'] ?? 'M j, Y') == 'j M, Y') ? 'selected' : '' ?>>15 Jan, 2025</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="time_zone" class="block text-sm font-medium text-gray-300 mb-1.5">Time Zone</label>
                                        <select id="time_zone" name="time_zone"
                                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                            <option value="UTC" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'UTC') ? 'selected' : '' ?>>UTC</option>
                                            <optgroup label="United Kingdom">
                                                <option value="Europe/London" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/London') ? 'selected' : '' ?>>London (GMT/BST)</option>
                                            </optgroup>
                                            <optgroup label="United States">
                                                <option value="America/New_York" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/New_York') ? 'selected' : '' ?>>New York (EST/EDT)</option>
                                                <option value="America/Chicago" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Chicago') ? 'selected' : '' ?>>Chicago (CST/CDT)</option>
                                                <option value="America/Denver" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Denver') ? 'selected' : '' ?>>Denver (MST/MDT)</option>
                                                <option value="America/Los_Angeles" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Los_Angeles') ? 'selected' : '' ?>>Los Angeles (PST/PDT)</option>
                                            </optgroup>
                                            <optgroup label="Europe">
                                                <option value="Europe/Paris" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Paris') ? 'selected' : '' ?>>Paris (CET/CEST)</option>
                                                <option value="Europe/Berlin" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Berlin') ? 'selected' : '' ?>>Berlin (CET/CEST)</option>
                                                <option value="Europe/Amsterdam" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Amsterdam') ? 'selected' : '' ?>>Amsterdam (CET/CEST)</option>
                                                <option value="Europe/Madrid" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Madrid') ? 'selected' : '' ?>>Madrid (CET/CEST)</option>
                                                <option value="Europe/Rome" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Rome') ? 'selected' : '' ?>>Rome (CET/CEST)</option>
                                                <option value="Europe/Istanbul" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Istanbul') ? 'selected' : '' ?>>Istanbul (TRT)</option>
                                                <option value="Europe/Moscow" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Europe/Moscow') ? 'selected' : '' ?>>Moscow (MSK)</option>
                                            </optgroup>
                                            <optgroup label="Asia">
                                                <option value="Asia/Dubai" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Dubai') ? 'selected' : '' ?>>Dubai (GST)</option>
                                                <option value="Asia/Kolkata" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Kolkata') ? 'selected' : '' ?>>Kolkata (IST)</option>
                                                <option value="Asia/Dhaka" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Dhaka') ? 'selected' : '' ?>>Dhaka (BST)</option>
                                                <option value="Asia/Singapore" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Singapore') ? 'selected' : '' ?>>Singapore (SGT)</option>
                                                <option value="Asia/Hong_Kong" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Hong_Kong') ? 'selected' : '' ?>>Hong Kong (HKT)</option>
                                                <option value="Asia/Shanghai" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Shanghai') ? 'selected' : '' ?>>Shanghai (CST)</option>
                                                <option value="Asia/Tokyo" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Tokyo') ? 'selected' : '' ?>>Tokyo (JST)</option>
                                                <option value="Asia/Seoul" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Seoul') ? 'selected' : '' ?>>Seoul (KST)</option>
                                                <option value="Asia/Karachi" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Karachi') ? 'selected' : '' ?>>Karachi (PKT)</option>
                                                <option value="Asia/Jakarta" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Asia/Jakarta') ? 'selected' : '' ?>>Jakarta (WIB)</option>
                                            </optgroup>
                                            <optgroup label="Africa">
                                                <option value="Africa/Cairo" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Africa/Cairo') ? 'selected' : '' ?>>Cairo (EET)</option>
                                                <option value="Africa/Lagos" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Africa/Lagos') ? 'selected' : '' ?>>Lagos (WAT)</option>
                                                <option value="Africa/Nairobi" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Africa/Nairobi') ? 'selected' : '' ?>>Nairobi (EAT)</option>
                                                <option value="Africa/Johannesburg" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Africa/Johannesburg') ? 'selected' : '' ?>>Johannesburg (SAST)</option>
                                            </optgroup>
                                            <optgroup label="South America">
                                                <option value="America/Sao_Paulo" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Sao_Paulo') ? 'selected' : '' ?>>Sao Paulo (BRT)</option>
                                                <option value="America/Buenos_Aires" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Buenos_Aires') ? 'selected' : '' ?>>Buenos Aires (ART)</option>
                                                <option value="America/Bogota" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'America/Bogota') ? 'selected' : '' ?>>Bogota (COT)</option>
                                            </optgroup>
                                            <optgroup label="Oceania">
                                                <option value="Australia/Sydney" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Australia/Sydney') ? 'selected' : '' ?>>Sydney (AEST/AEDT)</option>
                                                <option value="Australia/Melbourne" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Australia/Melbourne') ? 'selected' : '' ?>>Melbourne (AEST/AEDT)</option>
                                                <option value="Pacific/Auckland" <?= (old('time_zone', $settings['time_zone'] ?? 'UTC') == 'Pacific/Auckland') ? 'selected' : '' ?>>Auckland (NZST/NZDT)</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                                <h3 class="text-white font-semibold text-sm mb-4">Performance</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="website_cache" class="block text-sm font-medium text-gray-300 mb-1.5">Cache Duration</label>
                                        <select id="website_cache" name="website_cache"
                                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                            <option value="0" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '0') ? 'selected' : '' ?>>Disabled</option>
                                            <option value="300" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '300') ? 'selected' : '' ?>>5 minutes</option>
                                            <option value="900" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '900') ? 'selected' : '' ?>>15 minutes</option>
                                            <option value="1800" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '1800') ? 'selected' : '' ?>>30 minutes</option>
                                            <option value="3600" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '3600') ? 'selected' : '' ?>>1 hour</option>
                                            <option value="7200" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '7200') ? 'selected' : '' ?>>2 hours</option>
                                            <option value="21600" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '21600') ? 'selected' : '' ?>>6 hours</option>
                                            <option value="86400" <?= (old('website_cache', $settings['website_cache'] ?? '0') == '86400') ? 'selected' : '' ?>>1 day</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save Settings</button>
                        <button type="reset" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Reset</button>
                    </div>
                </form>
<?= view('admin/layout/footer') ?>
