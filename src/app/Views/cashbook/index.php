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

<div x-data="cashbookManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    </header>

    <!-- Filter Controls -->
    <div class="mb-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
        <div x-show="!loading && cashbooks.length === 0" class="p-4 text-center bg-yellow-50 text-yellow-800">
            No cashbook records found. Try adjusting your filters.
        </div>

        <!-- Table Content -->
        <div x-show="!loading && cashbooks.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="sticky bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                            Date
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                            In Amount
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                            Out Amount
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                    <template x-for="(cashbook, index) in cashbooks" :key="cashbook.id">
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900" x-text="cashbook.formatted_date"></div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <div class="text-sm font-medium text-green-600">
                                    <template x-if="cashbook.in_amount > 0">
                                        <span x-text="new Intl.NumberFormat().format(cashbook.in_amount)"></span>
                                    </template>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <div class="text-sm font-medium text-red-600">
                                    <template x-if="cashbook.out_amount > 0">
                                        <span x-text="new Intl.NumberFormat().format(cashbook.out_amount)"></span>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </template>

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div x-show="!loading && cashbooks.length > 0" class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
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
</div>

<script>
    function cashbookManager() {
        return {
            cashbooks: [],
            currentPage: 1,
            perPage: <?= $paginate_rows ?? 10 ?>,
            totalRecords: 0,
            filteredCount: 0,
            hasMore: false,
            startDate: '',
            endDate: '',
            loading: false,
            sortField: 'created_at',
            sortDirection: 'desc',
            error: null,

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
                this.fetchCashbooks();
            },

            fetchCashbooks() {
                this.loading = true;
                this.error = null;

                let url = `<?= site_url('cashbook/list') ?>?page=${this.currentPage}&sort=${this.sortField}&direction=${this.sortDirection}`;

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
                            this.cashbooks = response.data.map(cashbook => ({
                                ...cashbook,
                                formatted_date: this.formatDate(cashbook.created_at)
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
                        this.error = error.message || 'Failed to load cashbook data';
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
                    this.fetchCashbooks();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchCashbooks();
                }
            },

            goToPage(page) {
                if (page !== this.currentPage) {
                    this.currentPage = page;
                    this.fetchCashbooks();
                }
            },

            applyFilters() {
                this.currentPage = 1;
                this.fetchCashbooks();
            },

            resetFilters() {
                this.startDate = '';
                this.endDate = '';
                this.sortField = 'created_at';
                this.sortDirection = 'desc';
                this.currentPage = 1;
                this.fetchCashbooks();
            },
        }
    }
</script>