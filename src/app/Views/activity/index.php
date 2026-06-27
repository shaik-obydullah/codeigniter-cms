<style>
    .table-container {
        max-height: calc(100vh - 300px);
        overflow-y: auto;
    }

    thead.sticky th {
        position: sticky;
        top: 0;
        background-color: #f9fafb;
        z-index: 10;
    }

    [x-cloak] {
        display: none !important;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div x-data="activityManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    </header>

    <!-- Filter Controls -->
    <div class="mb-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="ipAddress" class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                <input type="text" id="ipAddress" x-model="ipAddress" @input="applyFilters()" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by IP Address">
            </div>
            <div>
                <label for="visitorCountry" class="block text-sm font-medium text-gray-700 mb-1">Visitor Country</label>
                <input type="text" id="visitorCountry" x-model="visitorCountry" @input="applyFilters()" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by Country">
            </div>
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                <input type="date" id="startDate" x-model="startDate" @change="applyFilters()" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                <input type="date" id="endDate" x-model="endDate" @change="applyFilters()" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div class="mt-3 flex justify-end">
            <button @click="resetFilters()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Reset Filters
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Loading Indicator -->
        <div x-show="loading" class="p-4 bg-blue-50 text-blue-800 rounded-lg flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading data...
        </div>

        <!-- Empty State -->
        <div x-show="!loading && activities.length === 0" class="p-4 text-center bg-yellow-50 text-yellow-800">
            No activity records found. Try adjusting your filters.
        </div>

        <!-- Table Content -->
        <div x-show="!loading && activities.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Admin Name</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wide">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">IP Address</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Country</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">State</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">City</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <template x-for="(activity, index) in activities" :key="activity.id">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="activity.created_at"></td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 capitalize" x-text="activity.admin_name"></td>
                            <td class="px-4 py-3 text-center">
                                <template x-if="activity.type === 'success'">
                                    <span class="inline-block rounded-full bg-green-100 text-green-800 text-xs font-semibold px-3 py-1">Success</span>
                                </template>
                                <template x-if="activity.type === 'warning'">
                                    <span class="inline-block rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1">Warning</span>
                                </template>
                                <template x-if="activity.type === 'error'">
                                    <span class="inline-block rounded-full bg-red-100 text-red-800 text-xs font-semibold px-3 py-1">Error</span>
                                </template>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 line-clamp-2" x-text="activity.name"></td>
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="activity.ip_address"></td>
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="activity.visitor_country"></td>
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="activity.visitor_state"></td>
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="activity.visitor_city"></td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button @click="openViewModal(activity)" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4.5C7.3 4.5 3.26 7.57 1.5 12c1.76 4.43 5.8 7.5 10.5 7.5s8.74-3.07 10.5-7.5C20.74 7.57 16.7 4.5 12 4.5zM12 17a5 5 0 110-10 5 5 0 010 10zm0-2.25a2.75 2.75 0 100-5.5 2.75 2.75 0 000 5.5z" />
                                        </svg>
                                        View
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div x-show="!loading && activities.length > 0" class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <button @click="previousPage()" :disabled="currentPage === 1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50" :class="{'opacity-50 cursor-not-allowed': currentPage === 1}">
                    Previous
                </button>
                <button @click="nextPage()" :disabled="!hasMore" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50" :class="{'opacity-50 cursor-not-allowed': !hasMore}">
                    Next
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium" x-text="(currentPage - 1) * perPage + 1"></span> to
                        <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredCount)"></span> of
                        <span class="font-medium" x-text="filteredCount"></span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <button @click="previousPage()" :disabled="currentPage === 1" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" :class="{'opacity-50 cursor-not-allowed': currentPage === 1}">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="goToPage(page)" aria-current="page" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="{
                                    'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': currentPage === page,
                                    'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': currentPage !== page
                                }" x-text="page">
                            </button>
                        </template>
                        <button @click="nextPage()" :disabled="!hasMore" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" :class="{'opacity-50 cursor-not-allowed': !hasMore}">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800" x-text="isView ? 'View Activity' : 'New Activity'"></h2>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Name</span>
                        <span class="text-gray-900 font-semibold" x-text="selectedActivity.name"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Type</span>
                        <div>
                            <template x-if="selectedActivity.type === 'success'">
                                <span class="inline-block rounded-full bg-green-100 text-green-800 text-xs font-semibold px-3 py-1">Success</span>
                            </template>
                            <template x-if="selectedActivity.type === 'warning'">
                                <span class="inline-block rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1">Warning</span>
                            </template>
                            <template x-if="selectedActivity.type === 'error'">
                                <span class="inline-block rounded-full bg-red-100 text-red-800 text-xs font-semibold px-3 py-1">Error</span>
                            </template>
                        </div>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">IP Address</span>
                        <span class="text-gray-900" x-text="selectedActivity.ip_address"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Country</span>
                        <span class="text-gray-900" x-text="selectedActivity.visitor_country"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">State</span>
                        <span class="text-gray-900" x-text="selectedActivity.visitor_state"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">City</span>
                        <span class="text-gray-900" x-text="selectedActivity.visitor_city"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Address</span>
                        <span class="text-gray-900" x-text="selectedActivity.visitor_address"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Date</span>
                        <span class="text-gray-900" x-text="selectedActivity.formatted_date"></span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Admin</span>
                        <span class="text-gray-900 font-semibold capitalize" x-text="selectedActivity.admin_name"></span>
                    </div>

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700" x-text="isView ? 'View Activity' : 'Create Activity'">
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function activityManager() {
        return {
            activities: [],
            currentPage: 1,
            perPage: <?= $paginate_rows ?? 10 ?>,
            totalRecords: 0,
            filteredCount: 0,
            selectedActivity: {},
            hasMore: false,
            startDate: '',
            endDate: '',
            ipAddress: '',
            visitorCountry: '',
            loading: false,
            sortField: 'created_at',
            sortDirection: 'desc',
            error: null,
            isView: false,
            showModal: false,
            csrfToken: '<?= csrf_hash() ?>',

            get visiblePages() {
                const totalPages = Math.ceil(this.filteredCount / this.perPage);
                const visiblePages = [];
                const maxVisible = 5;

                let start = Math.max(1, this.currentPage - Math.floor(maxVisible / 2));
                let end = Math.min(totalPages, start + maxVisible - 1);

                if (end - start + 1 < maxVisible) {
                    start = Math.max(1, end - maxVisible + 1);
                }

                for (let i = start; i <= end; i++) {
                    visiblePages.push(i);
                }

                return visiblePages;
            },

            init() {
                this.fetchActivities();
            },

            fetchActivities() {
                this.loading = true;
                this.error = null;

                let url = `<?= site_url('activity/list') ?>?page=${this.currentPage}&sort=${this.sortField}&direction=${this.sortDirection}`;

                if (this.ipAddress) url += `&ip_address=${encodeURIComponent(this.ipAddress)}`;
                if (this.visitorCountry) url += `&visitor_country=${encodeURIComponent(this.visitorCountry)}`;
                if (this.startDate) url += `&start_date=${this.startDate}`;
                if (this.endDate) url += `&end_date=${this.endDate}`;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(response => {
                    if (response.success) {
                        this.activities = response.data.map(activity => ({
                            ...activity,
                            formatted_date: this.formatDate(activity.created_at)
                        }));
                        this.totalRecords = response.total_records;
                        this.filteredCount = response.filtered_count;
                        this.hasMore = response.has_more;
                    } else {
                        throw new Error(response.error || 'Unknown error occurred');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.error = error.activity || 'Failed to load activity data';
                })
                .finally(() => {
                    this.loading = false;
                });
            },

            formatDate(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },

            nextPage() {
                if (this.hasMore) {
                    this.currentPage++;
                    this.fetchActivities();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchActivities();
                }
            },

            goToPage(page) {
                if (page !== this.currentPage) {
                    this.currentPage = page;
                    this.fetchActivities();
                }
            },

            applyFilters() {
                this.currentPage = 1;
                this.fetchActivities();
            },

            resetFilters() {
                this.ipAddress = '';
                this.visitorCountry = '';
                this.startDate = '';
                this.endDate = '';
                this.currentPage = 1;
                this.fetchActivities();
            },

            openViewModal(activity) {
                this.isView = true;
                this.selectedActivity = { ...activity };
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },
        }
    }
</script>