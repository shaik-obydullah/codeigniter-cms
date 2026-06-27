<div x-data="settingsManager()" x-init="loadSettings()" class="min-h-screen bg-gray-50 p-6" x-cloak>
    <div class="max-w-6xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">System Settings</h1>
            <p class="text-gray-600 mt-2">Manage your application configurations</p>
        </header>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Sidebar Navigation -->
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-64 border-b md:border-b-0 md:border-r border-gray-200 bg-gray-50">
                    <nav class="p-4">
                        <div class="space-y-1">
                            <button @click="currentSection = 'general'" :class="{'bg-white shadow-sm border border-gray-200': currentSection === 'general'}" class="w-full text-left px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                                General
                            </button>
                            <button @click="currentSection = 'seo'" :class="{'bg-white shadow-sm border border-gray-200': currentSection === 'seo'}" class="w-full text-left px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                                SEO
                            </button>
                            <button @click="currentSection = 'social'" :class="{'bg-white shadow-sm border border-gray-200': currentSection === 'social'}" class="w-full text-left px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                                Social
                            </button>
                            <button @click="currentSection = 'security'" :class="{'bg-white shadow-sm border border-gray-200': currentSection === 'security'}" class="w-full text-left px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                                Security
                            </button>
                            <button @click="currentSection = 'regional'" :class="{'bg-white shadow-sm border border-gray-200': currentSection === 'regional'}" class="w-full text-left px-4 py-2 text-sm font-medium rounded-lg transition-colors">
                                Regional
                            </button>
                        </div>
                    </nav>
                </div>

                <!-- Main Content Area -->
                <div class="flex-1 p-6">
                    <!-- General Settings -->
                    <div x-show="currentSection === 'general'" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">General Settings</h2>

                        <div class="space-y-4">
                            <!-- Project Name -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                    <p class="text-xs text-gray-500 mt-1">The name displayed throughout the application</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="project_name" x-model="settings.project_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label for="paginate_rows" class="block text-sm font-medium text-gray-700">Pagination</label>
                                    <p class="text-xs text-gray-500 mt-1">Number of rows displayed in tables</p>
                                </div>
                                <div class="md:col-span-2">
                                    <select id="paginate_rows" x-model="settings.paginate_rows" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div x-show="currentSection === 'seo'" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">SEO Settings</h2>

                        <div class="space-y-4">
                            <!-- Meta Title -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="meta_title" x-model="settings.meta_title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                            <!-- Meta Description -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO and social media sharing</p>
                                </div>
                                <div class="md:col-span-2">
                                    <textarea id="meta_description" x-model="settings.meta_description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                            <!-- Meta Keyword -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_keyword" class="block text-sm font-medium text-gray-700">Meta Keyword</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO</p>
                                </div>
                                <div class="md:col-span-2">
                                    <textarea id="meta_keyword" x-model="settings.meta_keyword" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                            <!-- Meta Copyright -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_copyright" class="block text-sm font-medium text-gray-700">Meta Copyright</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="meta_copyright" x-model="settings.meta_copyright" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                            <!-- Meta URL -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_url" class="block text-sm font-medium text-gray-700">Meta URL</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="meta_url" x-model="settings.meta_url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                            <!-- Meta Image -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="meta_image" class="block text-sm font-medium text-gray-700">Meta Image</label>
                                    <p class="text-xs text-gray-500 mt-1">Used for SEO</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="meta_image" x-model="settings.meta_image" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Settings -->
                    <div x-show="currentSection === 'social'" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Social Settings</h2>

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="linkedin" class="block text-sm font-medium text-gray-700">Linkedin</label>
                                    <p class="text-xs text-gray-500 mt-1">Linkedin Profile</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="linkedin" x-model="settings.linkedin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                                <div>
                                    <label for="github" class="block text-sm font-medium text-gray-700">GitHub</label>
                                    <p class="text-xs text-gray-500 mt-1">GitHub Profile</p>
                                </div>
                                <div class="md:col-span-2">
                                    <input type="text" id="github" x-model="settings.github" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div x-show="currentSection === 'security'" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Security Settings</h2>

                        <div class="space-y-4">
                            <!-- Website Cache -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Caching</label>
                                    <p class="text-xs text-gray-500 mt-1">Improves performance</p>
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <!-- Caching Toggle -->
                                    <div class="flex items-center">
                                        <input type="checkbox" id="website_cache" x-model="settings.website_cache" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="website_cache" class="ml-2 block text-sm text-gray-700">Enable website caching</label>
                                    </div>

                                    <!-- Caching Duration -->
                                    <div class="flex items-center space-x-2" x-show="settings.website_cache">
                                        <label for="cache_duration" class="text-sm text-gray-700">Duration:</label>
                                        <select id="cache_duration" x-model="settings.cache_duration" class="mt-1 block w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                            <option value="1h">1 Hour</option>
                                            <option value="6h">6 Hours</option>
                                            <option value="12h">12 Hours</option>
                                            <option value="1d">1 Day</option>
                                            <option value="7d">7 Days</option>
                                            <option value="30d">30 Days</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Regional Settings -->
                    <div x-show="currentSection === 'regional'" class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Regional Settings</h2>

                        <div class="space-y-4">
                            <!-- Time Zone -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label for="time_zone" class="block text-sm font-medium text-gray-700">Time Zone</label>
                                    <p class="text-xs text-gray-500 mt-1">Affects date and time displays</p>
                                </div>
                                <div class="md:col-span-2">
                                    <select id="time_zone" x-model="settings.time_zone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="Europe/London">London</option>
                                        <option value="America/New_York">New York</option>
                                        <option value="Asia/Dhaka">Dhaka</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Date Format -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label for="date_format" class="block text-sm font-medium text-gray-700">Date Format</label>
                                    <p class="text-xs text-gray-500 mt-1">How dates are displayed</p>
                                </div>
                                <div class="md:col-span-2">
                                    <select id="date_format" x-model="settings.date_format" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="F j, Y">January 1, 2023</option>
                                        <option value="Y-m-d">2023-01-01</option>
                                        <option value="m/d/Y">01/01/2023</option>
                                        <option value="d/m/Y">01/01/2023</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Time Format -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label for="time_format" class="block text-sm font-medium text-gray-700">Time Format</label>
                                    <p class="text-xs text-gray-500 mt-1">How times are displayed</p>
                                </div>
                                <div class="md:col-span-2">
                                    <select id="time_format" x-model="settings.time_format" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="g:i A">12:00 PM</option>
                                        <option value="H:i">24:00</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Default Currency -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <div>
                                    <label for="default_currency" class="block text-sm font-medium text-gray-700">Default Currency</label>
                                    <p class="text-xs text-gray-500 mt-1">For monetary values</p>
                                </div>
                                <div class="md:col-span-2">
                                    <select id="default_currency" x-model="settings.default_currency" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <template x-for="currency in JSON.parse(settings.currencies)" :key="currency.code">
                                            <option :value="currency.code" x-text="`${currency.name} (${currency.symbol})`"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                <div class="flex justify-end items-center space-x-4">
                    <!-- Success Message -->
                    <div x-show="saveSuccess" x-transition class="text-green-600 text-sm">
                        <span x-text="saveSuccess"></span>
                    </div>

                    <!-- Error Message -->
                    <div x-show="saveError" x-transition class="text-red-600 text-sm">
                        <span x-text="saveError"></span>
                    </div>

                    <!-- Loading Spinner -->
                    <svg x-show="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>

                    <button @click="saveSettings()" :disabled="isLoading" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function settingsManager() {
            return {
                currentSection: 'general',
                settings: {
                    project_name: '',
                    paginate_rows: '',

                    meta_title: '',
                    meta_description: '',
                    meta_keyword: '',
                    meta_copyright: '',
                    meta_url: '',
                    meta_image: '',

                    time_format: '',
                    date_format: '',
                    time_zone: '',

                    website_cache: 0,
                    cache_duration: false,
                    default_currency: '',
                    currencies: '[]'
                },
                isLoading: false,
                saveSuccess: false,
                saveError: false,
                csrfToken: '<?= csrf_hash() ?>',

                loadSettings() {
                    fetch('/getSetting')
                        .then(response => response.json())
                        .then(data => {
                            if (typeof data.currencies !== 'string') {
                                data.currencies = JSON.stringify(data.currencies || []);
                            }
                            this.settings = {
                                ...data,
                                website_cache: data.website_cache == 1 ? true : false
                            };

                        })
                        .catch(error => {
                            console.error('Error loading settings:', error);
                            this.settings.currencies = '[]';
                        });
                },

                async saveSettings() {
                    this.isLoading = true;
                    this.saveSuccess = false;
                    this.saveError = false;

                    try {
                        const response = await fetch('/setting/save', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken
                            },
                            body: JSON.stringify(this.settings)
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Failed to save settings');
                        }

                        this.saveSuccess = data.message;
                        this.csrfToken = data.csrf_token;
                    } catch (error) {
                        console.error('Error saving settings:', error);
                        this.saveError = error.message;
                    } finally {
                        this.isLoading = false;
                        setTimeout(() => {
                            this.saveSuccess = false;
                            this.saveError = false;
                        }, 5000);
                    }
                }
            }
        }
    </script>
</div>