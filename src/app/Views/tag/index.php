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

<div x-data="tagManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    </header>

    <!-- Filter Controls -->
    <div class="mb-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" id="search" x-model="search" x-on:input.debounce.500ms="applyFilters()" placeholder="Search Name..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
        <div x-show="!loading && tags.length === 0" class="p-4 text-center bg-yellow-50 text-yellow-800">
            No tag records found. Try adjusting your filters or create a new tag record.
        </div>

        <!-- Table Content -->
        <div x-show="!loading && tags.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="sticky bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                    <template x-for="(tag, index) in tags" :key="tag.id">
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900" x-text="tag.name"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 font-mono" x-text="tag.slug"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button @click="openEditModal(tag)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button @click="openDeleteModal(tag)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
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
        <div x-show="!loading && tags.length > 0" class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
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

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 md:bottom-8 md:right-8">
        <button @click="openCreateModal()" class="flex items-center justify-center p-3 bg-green-600 text-white rounded-full shadow-lg hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only">New Tag</span>
        </button>
    </div>

    <!-- Create/Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800" x-text="isEditing ? 'Edit Tag' : 'New Tag'"></h2>
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
                    <!-- Tag Name Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                        <input type="text" x-model="form.name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. JavaScript">
                        <template x-if="formErrors.name">
                            <p class="mt-1 text-sm text-red-600" x-text="formErrors.name"></p>
                        </template>
                    </div>

                    <!-- Slug Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" x-model="form.slug" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. javascript">
                        <template x-if="formErrors.slug">
                            <p class="mt-1 text-sm text-red-600" x-text="formErrors.slug"></p>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="submitForm()" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700" x-text="isEditing ? 'Update Tag' : 'Create Tag'">
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
                    <h2 class="text-xl font-semibold text-gray-800">Delete Tag</h2>
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
                        <p class="text-gray-700">You're about to delete the tag <strong class="font-medium" x-text="selectedTag.name"></strong>.</p>
                        <p class="text-gray-500 mt-1 text-sm">This action cannot be undone. All associated data will be permanently removed.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="showDeleteModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="deleteTag()" class="px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Tag
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function tagManager() {
        return {
            tags: [],
            currentPage: 1,
            perPage: <?= $paginate_rows ?? 10 ?>,
            totalRecords: 0,
            filteredCount: 0,
            search: '',
            hasMore: false,
            form: { id: null, name: '', slug: '' },
            formErrors: {},
            isEditing: false,
            showModal: false,
            loading: false,
            showDeleteModal: false,
            selectedTag: {},
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
                this.fetchTags();
                this.$watch('form.name', (value) => {
                    this.form.slug = this.generateSlug(value);
                });
            },

            generateSlug(text) {
                return text.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
            },

            fetchTags() {
                this.loading = true;
                this.error = null;

                let url = `<?= site_url('tag/list') ?>?page=${this.currentPage}`;

                if (this.search) url += `&search=${encodeURIComponent(this.search)}`;

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
                        this.tags = response.data.map(tag => ({
                            ...tag,
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
                    this.error = error.message || 'Failed to load tag data';
                })
                .finally(() => {
                    this.loading = false;
                });
            },

            nextPage() {
                if (this.hasMore) {
                    this.currentPage++;
                    this.fetchTags();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchTags();
                }
            },

            goToPage(page) {
                if (page !== this.currentPage) {
                    this.currentPage = page;
                    this.fetchTags();
                }
            },

            applyFilters() {
                this.currentPage = 1;
                this.fetchTags();
            },

            resetFilters() {
                this.search = '';
                this.currentPage = 1;
                this.fetchTags();
            },

            openCreateModal() {
                this.isEditing = false;
                this.form = { id: null, name: '', slug: '' };
                this.formErrors = {};
                this.showModal = true;
            },

            openEditModal(tag) {
                this.isEditing = true;
                this.form = { ...tag };
                this.formErrors = {};
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            submitForm() {
                const url = this.isEditing
                    ? `<?= site_url('tag/update/') ?>${this.form.id}`
                    : '<?= site_url('tag/create') ?>';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        name: this.form.name,
                        slug: this.form.slug,
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

                    if (this.isEditing) {
                        const idx = this.tags.findIndex(t => t.id === this.form.id);
                        if (idx !== -1) {
                            this.tags[idx] = {
                                ...this.tags[idx],
                                name: this.form.name,
                                slug: this.form.slug
                            };
                        }
                    } else {
                        this.tags.unshift(response.data.tag);
                    }

                    this.csrfToken = response.data.csrf_token || this.csrfToken;
                    this.showModal = false;
                    this.form = { id: null, name: '', slug: '' };
                    this.isEditing = false;
                    });
            },

            openDeleteModal(tag) {
                this.selectedTag = tag;
                this.showDeleteModal = true;
            },

            deleteTag() {
                fetch(`<?= site_url('tag/delete/') ?>${this.selectedTag.id}`, {
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
                        this.tags = this.tags.filter(t => t.id !== this.selectedTag.id);
                        this.showDeleteModal = false;
                        this.csrfToken = data.csrf_token || this.csrfToken;
                    } else {
                        alert('Failed to delete tag: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error deleting tag:', error);
                });
            }
        }
    }
</script>