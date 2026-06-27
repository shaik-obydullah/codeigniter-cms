<div x-data="walletManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    </header>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-right text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                <template x-for="(wallet, index) in wallets" :key="wallet.id">
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900" x-text="wallet.name"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 capitalize" x-text="wallet.category"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button @click="openEditModal(wallet)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Edit
                                </button>
                                <button @click="openDeleteModal(wallet)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200">
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

    <div class="fixed bottom-6 right-6 md:bottom-8 md:right-8">
        <button @click="openCreateModal()" class="flex items-center justify-center p-3 bg-green-600 text-white rounded-full shadow-lg hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only">New Wallet</span>
        </button>
    </div>

    <!-- Create/Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800" x-text="isEditing ? 'Edit Wallet' : 'New Wallet'"></h2>
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
                    <!-- Wallet Name Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Wallet Name</label>
                        <input type="text" x-model="form.name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Savings Account">
                        <template x-if="formErrors.name">
                            <p class="mt-1 text-sm text-red-600" x-text="formErrors.name"></p>
                        </template>
                    </div>

                    <!-- Category Radio Buttons -->
                    <div class="flex space-x-6">
                        <div class="flex items-center space-x-2">
                            <input id="income" type="radio" x-model="form.category" value="income" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <label for="income" class="text-sm font-medium text-gray-700">
                                Income
                            </label>
                        </div>

                        <div class="flex items-center space-x-2">
                            <input id="expense" type="radio" x-model="form.category" value="expense" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <label for="expense" class="text-sm font-medium text-gray-700">
                                Expense
                            </label>
                        </div>
                    </div>

                    <!-- Category Validation Error -->
                    <template x-if="formErrors.category">
                        <p class="mt-1 text-sm text-red-600" x-text="formErrors.category"></p>
                    </template>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="submitForm()" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700" x-text="isEditing ? 'Update Wallet' : 'Create Wallet'">
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
                    <h2 class="text-xl font-semibold text-gray-800">Delete Wallet</h2>
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
                        <p class="text-gray-700">You're about to delete <strong class="font-medium" x-text="selectedWallet.name"></strong>.</p>
                        <p class="text-gray-500 mt-1 text-sm">This action cannot be undone. All associated data will be permanently removed.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="showDeleteModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button @click="deleteWallet()" class="px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Wallet
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function walletManager() {
        return {
            wallets: [],
            form: { id: null, name: '', category: '' },
            formErrors: {},
            isEditing: false,
            showModal: false,
            showDeleteModal: false,
            selectedWallet: {},
            csrfToken: '<?= csrf_hash() ?>',

            init() {
                this.fetchWallets();
            },

            fetchWallets() {
                fetch('<?= site_url('wallet') ?>', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(res => res.json())
                    .then(data => this.wallets = data);
            },

            openCreateModal() {
                this.isEditing = false;
                this.form = { id: null, name: '', category: '' };
                this.formErrors = {};
                this.showModal = true;
            },

            openEditModal(wallet) {
                this.isEditing = true;
                this.form = { ...wallet };
                this.formErrors = {};
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            submitForm() {
                const url = this.isEditing
                    ? `<?= site_url('wallet/update/') ?>${this.form.id}`
                    : '<?= site_url('wallet/create') ?>';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        name: this.form.name,
                        category: this.form.category,
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
                        const idx = this.wallets.findIndex(w => w.id === this.form.id);
                        if (idx !== -1) this.wallets[idx].name = this.form.name;
                    } else {
                        this.wallets.push(response.data.wallet);
                    }

                    this.csrfToken = response.data.csrf_token || this.csrfToken;
                    this.showModal = false;
                });
            },

            openDeleteModal(wallet) {
                this.selectedWallet = wallet;
                this.showDeleteModal = true;
            },

            deleteWallet() {
                fetch(`<?= site_url('wallet/delete/') ?>${this.selectedWallet.id}`, {
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
                        this.wallets = this.wallets.filter(w => w.id !== this.selectedWallet.id);
                        this.showDeleteModal = false;
                        this.csrfToken = data.csrf_token || this.csrfToken;
                    } else {
                        alert('Failed to delete wallet: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error deleting wallet:', error);
                });
            }
        }
    }
</script>