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
<div x-data="mediaManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    </header>
    <!-- Filter Controls -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" id="search" x-model="search" x-on:input.debounce.500ms="applyFilters()" placeholder="Search Name..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">File Type</label>
                <select id="type" x-model="type" @change="applyFilters()" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    <option value="image">Image</option>
                    <option value="document">Document</option>
                </select>
            </div>
        </div>
        <div class="mt-3 flex justify-end">
            <button @click="resetFilters()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
        <div x-show="!loading && medias.length === 0" class="p-8 text-center bg-gray-50 text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No media found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or create a new media item.</p>
            <div class="mt-6">
                <button @click="openCreateModal()" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    New Media
                </button>
            </div>
        </div>
        <!-- Table Content -->
        <div x-show="!loading && medias.length > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="sticky bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <template x-for="media in medias" :key="media.id">
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <template x-if="media.type === 'image'">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"></circle>
                                        </svg>
                                        Image
                                    </span>
                                </template>
                                <template x-if="media.type === 'document'">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-purple-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"></circle>
                                        </svg>
                                        Document
                                    </span>
                                </template>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="media.name"></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <template x-if="media.type === 'image' && media.url">
                                        <img :src="`/uploads/media-library/${media.url}`" class="h-10 w-10 rounded-md object-cover" alt="Image file">
                                    </template>
                                    <template x-if="media.type !== 'image' || !media.url">
                                        <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2 items-center">
                                    <!-- Copy Button -->
                                    <div x-data="{ copied: false }">
                                        <button @click="
                                            navigator.clipboard.writeText(`<?= base_url() ?>uploads/media-library/${media.url}`).then(() => { copied = true; setTimeout(() => copied = false, 1500); })
                                        " class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2M16 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2v-2" />
                                            </svg>
                                            <span x-show="!copied">Copy Link</span>
                                            <span x-show="copied" class="text-green-600">Copied!</span>
                                        </button>
                                    </div>
                                    <!-- Edit Button -->
                                    <button @click="openEditModal(media)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <!-- Delete Button -->
                                    <button @click="openDeleteModal(media)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200">
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
        <div x-show="!loading && medias.length > 0" class="flex items-center justify-between px-6 py-4 bg-white border-t border-gray-200">
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
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="goToPage(page)" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="{
                                        'z-10 bg-blue-50 border-blue-500 text-blue-600': currentPage === page,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': currentPage !== page
                                    }" x-text="page">
                            </button>
                        </template>
                        <button @click="nextPage()" :disabled="!hasMore" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" :class="{'opacity-50 cursor-not-allowed': !hasMore}">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 md:bottom-8 md:right-8">
        <button @click="openCreateModal()" class="flex items-center justify-center p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">New Media</span>
        </button>
    </div>

    <!-- Create/Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800" x-text="isEditing ? 'Edit Media' : 'New Media'"></h2>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-8">
                <div class="space-y-6">
                    <!-- Name Field -->
                    <div class="group">
                        <label class="block text-lg font-semibold text-gray-800 mb-2 transition-all duration-200 group-focus-within:text-blue-600">Name</label>
                        <input type="text" x-model="form.name" class="w-full px-5 py-3 text-lg border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 placeholder-gray-400 transition-all duration-200 shadow-sm hover:shadow-md" placeholder="Enter file name">
                        <template x-if="formErrors.name">
                            <p class="mt-2 text-sm text-red-500 animate-fade-in" x-text="formErrors.name"></p>
                        </template>
                    </div>
                    <!-- Type Field -->
                    <div class="group">
                        <label class="block text-lg font-semibold text-gray-800 mb-2 transition-all duration-200 group-focus-within:text-blue-600">Type</label>
                        <select x-model="form.type" class="w-full px-5 py-3 text-lg border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 shadow-sm hover:shadow-md appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiAjdjY3NWYwIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBvbHlsaW5lIHBvaW50cz0iNiA5IDEyIDE1IDE4IDkiPjwvcG9seWxpbmU+PC9zdmc+')] bg-no-repeat bg-[center_right_1rem]">
                            <option value="" disabled selected>Select Type</option>
                            <option value="image">Image</option>
                            <option value="document">Document</option>
                        </select>
                        <template x-if="formErrors.type">
                            <p class="mt-2 text-sm text-red-500 animate-fade-in" x-text="formErrors.type"></p>
                        </template>
                    </div>

                    <!-- File Upload Field -->
                    <div class="group">
                        <label class="block text-lg font-semibold text-gray-800 mb-2 transition-all duration-200 group-focus-within:text-blue-600">Upload File</label>
                        <div class="mt-1 flex justify-center px-6 pt-8 pb-10 border-2 border-gray-200 border-dashed rounded-2xl transition-all duration-300 hover:border-blue-400 hover:bg-blue-50 hover:shadow-lg" @dragover.prevent="dragOver = true" @dragleave="dragOver = false" @drop.prevent="handleFileDrop($event)">
                            <div class="space-y-3 text-center">
                                <!-- File Preview -->
                                <div class="flex justify-center">
                                    <!-- Image Preview -->
                                    <template x-if="form.type === 'image' && form.url">
                                        <div class="relative group">
                                            <img :src="`/uploads/media-library/${form.url}`" class="h-24 w-24 rounded-xl object-cover shadow-md transition-transform duration-300 group-hover:scale-105">
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-xl transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </template>
                                    <!-- Download Button for Non-Image Files -->
                                    <template x-if="form.type !== 'image' && form.url">
                                        <a :href="`/uploads/media-library/${form.url}`" download class="inline-flex items-center px-4 py-2.5 border border-gray-300 text-lg font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 shadow-sm hover:shadow-md transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download File
                                        </a>
                                    </template>
                                </div>
                                <!-- File Input -->
                                <div class="flex justify-center text-sm text-gray-600">
                                    <label class="relative cursor-pointer rounded-xl font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none transition-colors duration-200">
                                        <span class="text-lg px-4 py-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-all duration-200 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span>Choose a file</span>
                                        </span>
                                        <input type="file" @change="handleFileUpload($event)" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-sm text-gray-500" x-text="form.file ? form.file.name : 'PNG, JPG, PDF up to 10MB'"></p>
                                <p class="text-sm text-gray-400">or drag and drop here</p>
                            </div>
                        </div>
                        <template x-if="formErrors.file">
                            <p class="mt-2 text-sm text-red-500 animate-fade-in" x-text="formErrors.file"></p>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="closeModal()" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button @click="submitForm()" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" x-text="isEditing ? 'Update Media' : 'Create Media'">
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
                    <h2 class="text-xl font-semibold text-gray-800">Delete Media</h2>
                    <button @click="showDeleteModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-700">You're about to delete <strong class="font-medium" x-text="selectedMedia.name"></strong>.</p>
                        <p class="text-gray-500 mt-1 text-sm">This action cannot be undone. All associated data will be permanently removed.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                <button @click="showDeleteModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button @click="deleteMedia()" class="px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Media
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function mediaManager() {
        return {
            medias: [],
            currentPage: 1,
            perPage: <?= $paginate_rows ?? 20 ?>,
            totalRecords: 0,
            filteredCount: 0,
            selectedMedia: false,
            hasMore: false,
            search: '',
            type: '',
            loading: false,
            error: null,
            form: { id: '', type: '', name: '', file: null },
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
                this.fetchMedias();
            },

            fetchMedias() {
                this.loading = true;
                this.error = null;

                let url = `<?= site_url('media/list') ?>?page=${this.currentPage}`;

                if (this.search) url += `&search=${encodeURIComponent(this.search)}`;
                if (this.type) url += `&type=${encodeURIComponent(this.type)}`;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(res => {
                        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                        return res.json();
                    })
                    .then(response => {
                        if (response.success) {
                            this.medias = response.data;
                            this.totalRecords = response.total_records;
                            this.filteredCount = response.filtered_count;
                            this.hasMore = response.has_more;
                        } else {
                            throw new Error(response.error || 'Unknown error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.error = error.message || 'Failed to load media data';
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            },

            copyToClipboard(text) {
                navigator.clipboard.writeText(text)
                    .then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy:', err);
                    });
            },

            nextPage() {
                if (this.hasMore) {
                    this.currentPage++;
                    this.fetchMedias();
                }
            },

            previousPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.fetchMedias();
                }
            },

            goToPage(page) {
                if (page !== this.currentPage) {
                    this.currentPage = page;
                    this.fetchMedias();
                }
            },

            applyFilters() {
                this.currentPage = 1;
                this.fetchMedias();
            },

            resetFilters() {
                this.search = '';
                this.type = '';
                this.currentPage = 1;
                this.fetchMedias();
            },

            openCreateModal() {
                this.isEditing = false;
                this.form = { id: '', name: '', type: '', file: null };
                this.formErrors = {};
                this.showModal = true;
            },

            openEditModal(media) {
                this.isEditing = true;
                this.form = { ...media };
                this.formErrors = {};
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
                this.formErrors = {};
            },

            handleFileUpload(event) {
                this.form.file = event.target.files[0];
            },

            submitForm() {
                const url = this.isEditing
                    ? `<?= site_url('media/update/') ?>${this.form.id}`
                    : '<?= site_url('media/create') ?>';

                const formData = new FormData();
                formData.append('type', this.form.type);
                formData.append('name', this.form.name);
                if (this.form.file) formData.append('file', this.form.file);
                formData.append('<?= csrf_token() ?>', this.csrfToken);

                fetch(url, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                })
                    .then(async res => {
                        const data = await res.json();
                        return { ok: res.ok, status: res.status, data };
                    })
                    .then(response => {
                        if (!response.ok) {
                            this.formErrors = response.data.errors || {};
                            this.csrfToken = response.data.csrf_token || this.csrfToken;
                            return;
                        }

                        if (this.isEditing) {
                            const idx = this.medias.findIndex(i => i.id === this.form.id);
                            if (idx !== -1) {
                                this.medias[idx] = response.data.media;
                            }
                        } else {
                            this.medias.unshift(response.data.media);
                        }

                        this.csrfToken = response.data.csrf_token || this.csrfToken;
                        this.showModal = false;
                        this.formErrors = {};
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.formErrors = { general: 'An error occurred while submitting the form' };
                    });
            },

            openDeleteModal(media) {
                this.selectedMedia = media;
                this.showDeleteModal = true;
            },

            deleteMedia() {
                fetch(`<?= site_url('media/delete/') ?>${this.selectedMedia.id}`, {
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
                            this.medias = this.medias.filter(m => m.id !== this.selectedMedia.id);
                            this.showDeleteModal = false;
                            this.csrfToken = data.csrf_token || this.csrfToken;
                        } else {
                            console.error('Failed to delete media:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting media:', error);
                    });
            }
        }
    }
</script>