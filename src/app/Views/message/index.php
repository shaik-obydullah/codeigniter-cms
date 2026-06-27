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

<div x-data="messageManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
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
        <div x-show="!loading && messages.length === 0" class="p-4 text-center bg-yellow-50 text-yellow-800">
            No message records found. Try adjusting your filters.
        </div>

        <!-- Table Content -->
        <div x-show="!loading && messages.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Subject</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Message</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <template x-for="(message, index) in messages" :key="message.id">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800" x-text="message.formatted_date"></td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900" x-text="message.subject"></td>
                            <td class="px-4 py-3 text-sm text-gray-700" x-text="message.email"></td>
                            <td class="px-4 py-3 text-sm text-gray-600 line-clamp-2" x-text="message.message"></td>
                            <td class="px-4 py-3 text-center">
                                <template x-if="message.status === 'seen'">
                                    <span class="inline-block rounded-full bg-green-100 text-green-800 text-xs font-semibold px-3 py-1">Seen</span>
                                </template>
                                <template x-if="message.status === 'unseen'">
                                    <span class="inline-block rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1">Unseen</span>
                                </template>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button @click="openViewModal(message)" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4.5C7.3 4.5 3.26 7.57 1.5 12c1.76 4.43 5.8 7.5 10.5 7.5s8.74-3.07 10.5-7.5C20.74 7.57 16.7 4.5 12 4.5zM12 17a5 5 0 110-10 5 5 0 010 10zm0-2.25a2.75 2.75 0 100-5.5 2.75 2.75 0 000 5.5z" />
                                        </svg>
                                        View
                                    </button>
                                    <button @click="openDeleteModal(message)" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-full shadow transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.89.55L7.38 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.38l-.72-1.45A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div x-show="!loading && messages.length > 0" class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
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
                    <h2 class="text-xl font-semibold text-gray-800" x-text="isEditing ? 'View Message' : 'New Message'"></h2>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-5">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <p class="text-gray-900" x-text="form.subject"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900" x-text="form.email"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <p class="text-gray-900 whitespace-pre-line" x-text="form.message"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <p class="text-gray-900" x-text="form.formatted_date"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select x-model="form.status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="seen">Seen</option>
                            <option value="unseen">Unseen</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="submitForm()" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700" x-text="isEditing ? 'View Message' : 'Create Message'">
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Delete Message</h2>
                    <button @click="showDeleteModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-5">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1 mr-4">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-red-100 text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-700">You're about to delete <strong class="font-medium" x-text="selectedMessage.subject"></strong>.</p>
                        <p class="text-gray-500 mt-1 text-sm">This action cannot be undone. All associated data will be permanently removed.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="showDeleteModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="deleteMessage()" class="px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Message
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function messageManager() {
        return {
            messages: [],
            currentPage: 1,
            perPage: <?= $paginate_rows ?? 10 ?>,
            totalRecords: 0,
            filteredCount: 0,
            selectedMessage: false,
            hasMore: false,
            startDate: '',
            endDate: '',
            loading: false,
            sortField: 'created_at',
            sortDirection: 'desc',
            error: null,
            form: { id: '', status: '' },
            formErrors: {},
            isEditing: false,
            showModal: false,
            showDeleteModal: false,
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
                this.fetchMessages();
            },

            fetchMessages() {
                this.loading = true;
                this.error = null;

                let url = `<?= site_url('message/list') ?>?page=${this.currentPage}&sort=${this.sortField}&direction=${this.sortDirection}`;

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
                        this.messages = response.data.map(message => ({
                            ...message,
                            formatted_date: this.formatDate(message.created_at)
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
                    this.error = error.message || 'Failed to load message data';
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
                    this.fetchMessages();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchMessages();
                }
            },

            goToPage(page) {
                if (page !== this.currentPage) {
                    this.currentPage = page;
                    this.fetchMessages();
                }
            },

            applyFilters() {
                this.currentPage = 1;
                this.fetchMessages();
            },

            resetFilters() {
                this.startDate = '';
                this.endDate = '';
                this.sortField = 'created_at';
                this.sortDirection = 'desc';
                this.currentPage = 1;
                this.fetchMessages();
            },

            openViewModal(message) {
                this.isEditing = true;
                this.form = { ...message };
                this.formErrors = {};
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            submitForm() {
                const url = `<?= site_url('message/update/') ?>${this.form.id}`;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        status: this.form.status,
                        '<?= csrf_token() ?>': this.csrfToken
                    })
                })
                .then(res => res.json().then(data => ({ ok: res.ok, status: res.status, data })))
                .then(response => {
                    if (!response.ok) {
                        this.formErrors = response.data.errors || {};
                        this.csrfToken = response.data.csrf_token || this.csrfToken;
                        return;
                    }

                    const idx = this.messages.findIndex(i => i.id === this.form.id);
                    if (idx !== -1) {
                        this.messages[idx].status = this.form.status;
                    }

                    this.csrfToken = response.data.csrf_token || this.csrfToken;
                    this.showModal = false;
                });
            },

            openDeleteModal(message) {
                this.selectedMessage = message;
                this.showDeleteModal = true;
            },

            deleteMessage() {
                fetch(`<?= site_url('message/delete/') ?>${this.selectedMessage.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        '<?= csrf_token() ?>': this.csrfToken
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.messages = this.messages.filter(w => w.id !== this.selectedMessage.id);
                        this.showDeleteModal = false;
                        this.csrfToken = data.csrf_token || this.csrfToken;
                    } else {
                        alert('Failed to delete message: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error deleting message:', error);
                });
            }
        }
    }
</script>