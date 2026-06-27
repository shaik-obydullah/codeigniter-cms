<div x-data="articleManager()" x-init="init()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
  <header class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800"><?= $title ?></h1>
    <nav class="flex mt-2">
      <a href="/dashboard/article" class="text-blue-600 hover:text-blue-800 text-sm">← Back to Articles</a>
    </nav>
  </header>
  <div class="bg-white rounded-xl shadow-md overflow-hidden">
    <form @submit.prevent="submitForm" class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
          <input type="text" id="title" x-model="form.title" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p x-show="errors.title" x-text="errors.title" class="mt-1 text-sm text-red-600"></p>
        </div>
        <div>
          <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug*</label>
          <div class="flex">
            <input type="text" id="slug" x-model="form.slug" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="button" @click="generateSlug()" class="ml-2 px-3 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm">
              Generate
            </button>
          </div>
          <p x-show="errors.slug" x-text="errors.slug" class="mt-1 text-sm text-red-600"></p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
          <select id="status" x-model="form.status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div style="display: none;">
          <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
          <div class="flex items-center">
            <input type="file" @change="handleFeaturedImageUpload" class="hidden" id="featuredImage" accept="image/*">
            <label for="featuredImage" class="px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 cursor-pointer text-sm">
              Choose File
            </label>
            <span x-text="form.image ? form.image.name || 'Image selected' : 'No file chosen'" class="ml-2 text-sm text-gray-500"></span>
          </div>
          <template x-if="form.image && (form.image instanceof File || typeof form.image === 'string')">
            <div class="mt-2">
              <img :src="form.image instanceof File ? URL.createObjectURL(form.image) : '/storage/' + form.image" alt="Preview" class="h-32 object-cover rounded">
              <button type="button" @click="form.image = null" class="mt-1 text-xs text-red-500 hover:text-red-700">
                Remove Image
              </button>
            </div>
          </template>
        </div>
      </div>
      <div class="mb-6">
        <label for="summary" class="block text-sm font-medium text-gray-700 mb-1">Summary*</label>
        <textarea id="summary" x-model="form.summary" rows="3" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
        <p x-show="errors.summary" x-text="errors.summary" class="mt-1 text-sm text-red-600"></p>
      </div>
      <!-- Include TinyMCE -->
      <script src="https://cdn.tiny.cloud/1/aj9gbow0nmvhy0xkztehf7xdc6xk9pq13ojnykygqkuncalz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      <!-- Enriched TinyMCE Component -->
      <div x-data x-init="tinymce.init({
          selector: '#content-editor',
          height: 400,
          menubar: 'file edit view insert format tools table',
          plugins: 'lists link image table code fullscreen visualblocks media help',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | table | removeformat | fullscreen code',
          toolbar_mode: 'wrap',
          branding: false,
          block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
          content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      })" class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Content*</label>
        <textarea id="content-editor" name="content" class="w-full h-40"></textarea>
      </div>
      <!-- Tag Input Field (Inside Your Form) -->
      <div x-data="tagSelector()" x-init="init()" class="relative mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-700">Tags</label>
        <div class="flex flex-wrap gap-2 items-center p-2 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 min-h-[42px]" @click="focusInput()">
          <template x-for="(tag, index) in form.tags" :key="index">
            <div class="flex items-center bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm">
              <span x-text="tag.name"></span>
              <button type="button" @click.stop="removeTag(index)" class="ml-1 text-blue-600 hover:text-blue-900 focus:outline-none">
                ×
              </button>
            </div>
          </template>
          <input x-ref="tagInput" x-model="inputValue" @input="filterSuggestions" @keydown.enter.prevent="addTag()" @keydown.arrow-down.prevent="highlightNext" @keydown.arrow-up.prevent="highlightPrev" class="flex-1 min-w-[100px] px-2 py-1 text-sm border-0 focus:ring-0 focus:outline-none" placeholder="Add tags..." />
        </div>
        <div x-show="showSuggestions && filteredSuggestions.length" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-auto">
          <template x-for="(suggestion, index) in filteredSuggestions" :key="index">
            <div class="px-4 py-2 text-sm cursor-pointer hover:bg-gray-100" :class="{ 'bg-blue-50': index === highlightedIndex }" @click="selectSuggestion(suggestion)" x-text="suggestion.name"></div>
          </template>
        </div>
      </div>
      <div class="flex gap-4 mb-9">
        <div class="flex-1">
          <label for="serial" class="block text-sm font-medium text-gray-700 mb-1">Website View Serial*</label>
          <input type="number" step="1" id="serial" x-model="form.serial" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p x-show="errors.serial" x-text="errors.serial" class="mt-1 text-sm text-red-600"></p>
        </div>
        <div class="flex-1">
          <label for="createdAt" class="block text-sm font-medium text-gray-700 mb-1">Created</label>
          <input type="date" id="createdAt" x-model="form.createdAt" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p x-show="errors.createdAt" x-text="errors.createdAt" class="mt-1 text-sm text-red-600"></p>
        </div>
        <div class="flex-1">
          <label for="updatedAt" class="block text-sm font-medium text-gray-700 mb-1">Updated</label>
          <input type="date" id="updatedAt" x-model="form.updatedAt" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <p x-show="errors.updatedAt" x-text="errors.updatedAt" class="mt-1 text-sm text-red-600"></p>
        </div>
      </div>
      <div x-show="successMessage" x-transition.duration.300ms class="flex items-start justify-between bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg p-4 mt-4" role="alert">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4m5 4a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
          </svg>
          <span x-text="successMessage"></span>
        </div>
        <button @click="successMessage = ''" class="ml-4 text-green-600 hover:text-green-800">
          &times;
        </button>
      </div>
      <div x-show="errors.general" x-transition.duration.300ms class="flex items-start justify-between bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg p-4 mt-4" role="alert">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
          <span x-text="errors.general"></span>
        </div>
        <button @click="errors.general = ''" class="ml-4 text-red-600 hover:text-red-800">
          &times;
        </button>
      </div>
      <!-- Form Actions -->
      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
        <a href="/articles" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
          Cancel
        </a>
        <button type="submit" :disabled="isSubmitting" class="bg-blue-600 text-white px-4 py-2 rounded disabled:opacity-50">
          <span x-show="!isSubmitting">Submit</span>
          <span x-show="isSubmitting">Submitting...</span>
        </button>
      </div>
    </form>
  </div>
</div>
<script>
  function tagSelector() {
    return {
      inputValue: '',
      allSuggestions: [],
      filteredSuggestions: [],
      showSuggestions: false,
      highlightedIndex: -1,

      get form() {
        return Alpine.store('articleForm').form;
      },

      async init() {
        try {
          const res = await fetch('/tag/search');
          const response = await res.json();

          if (response.success && response.data) {
            this.allSuggestions = response.data.map(item => ({
              id: item.id,
              name: item.name,
              slug: item.slug,
              created_at: item.created_at,
              created_by: item.created_by
            }));
          } else {
            console.error('Failed to fetch tags:', response);
            this.allSuggestions = [];
          }
        } catch (err) {
          console.error('Failed to fetch suggestions:', err);
          this.allSuggestions = [];
        }
      },

      focusInput() {
        this.$refs.tagInput.focus();
      },

      filterSuggestions() {
        const input = this.inputValue.toLowerCase();
        this.filteredSuggestions = this.allSuggestions
          .filter(item => {
            const itemName = item.name.toLowerCase();
            const isMatch = itemName.includes(input);
            const isAlreadyAdded = this.form.tags.some(tag => tag.id === item.id);
            return isMatch && !isAlreadyAdded;
          });
        this.highlightedIndex = -1;
        this.showSuggestions = this.filteredSuggestions.length > 0;
      },

      addTag() {
        const value = this.inputValue.trim();
        if (value) {
          const matchingSuggestion = this.allSuggestions.find(
            item => item.name.toLowerCase() === value.toLowerCase()
          );

          if (matchingSuggestion && !this.form.tags.some(tag => tag.id === matchingSuggestion.id)) {
            this.form.tags.push(matchingSuggestion);
          } else if (!this.form.tags.some(tag => tag.name.toLowerCase() === value.toLowerCase())) {
            this.form.tags.push({
              id: null,
              name: value,
              slug: value.toLowerCase().replace(/\s+/g, '-'),
              created_at: null,
              created_by: null
            });
          }
        }
        this.inputValue = '';
        this.filteredSuggestions = [];
        this.showSuggestions = false;
      },

      selectSuggestion(suggestion) {
        if (!this.form.tags.some(tag => tag.id === suggestion.id)) {
          this.form.tags.push(suggestion);
        }
        this.inputValue = '';
        this.filteredSuggestions = [];
        this.showSuggestions = false;
      },

      removeTag(index) {
        this.form.tags.splice(index, 1);
      },

      highlightNext() {
        if (this.filteredSuggestions.length === 0) return;
        this.highlightedIndex = (this.highlightedIndex + 1) % this.filteredSuggestions.length;
      },

      highlightPrev() {
        if (this.filteredSuggestions.length === 0) return;
        this.highlightedIndex = (this.highlightedIndex - 1 + this.filteredSuggestions.length) % this.filteredSuggestions.length;
      }
    };
  }
</script>
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.store('articleForm', {
      form: {
        title: '',
        serial: '',
        slug: '',
        summary: '',
        description: '',
        image: null,
        status: '',
        createdAt: '',
        updatedAt: '',
        tags: []
      }
    });
  });

  function articleManager() {
    return {
      get form() {
        return Alpine.store('articleForm').form;
      },
      errors: {},
      successMessage: '',
      isSubmitting: false,

      async submitForm() {
        try {
          this.isSubmitting = true;
          this.successMessage = '';
          this.errors = {};

          const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
          const csrfName = document.querySelector('meta[name="csrf-token-name"]').content;

          const formData = new FormData();
          formData.append(csrfName, csrfToken);

          formData.append('title', this.form.title);
          formData.append('slug', this.form.slug);
          formData.append('summary', this.form.summary);
          formData.append('status', document.getElementById('status').value);
          formData.append('description', tinymce.get('content-editor')?.getContent() || '');
          formData.append('serial', this.form.serial);
          formData.append('createdAt', this.form.createdAt);
          formData.append('updatedAt', this.form.updatedAt);

          if (this.form.image instanceof File) {
            formData.append('image', this.form.image);
          } else if (typeof this.form.image === 'string') {
            formData.append('image_url', this.form.image);
          }

          if (this.form.tags?.length) {
            formData.append('tags', JSON.stringify(this.form.tags));
          }

          const response = await fetch('<?= site_url('dashboard/article/create') ?>', {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': csrfToken
            },
            body: formData
          });

          const data = await response.json();

          if (!response.ok || data.success === false) {
            this.errors = data.errors || {};

            // Special handling for TinyMCE editor validation
            if (data.errors?.description) {
              // Add error class to editor container
              const editorContainer = document.querySelector('.tox-tinymce').parentElement;
              editorContainer.classList.add('border-red-500', 'border-2', 'p-5');

              // Focus the editor to draw attention
              tinymce.get('content-editor').focus();
            }

            if (data.message && !this.errors.general) {
              this.errors.general = data.message;
            }
            return;
          }

          this.successMessage = data.message || 'Article created successfully!';

          // Update CSRF token if provided
          if (data.csrf_token) {
            document.querySelector('meta[name="csrf-token"]').content = data.csrf_token;
          }
        } catch (error) {
          console.error('Submission error:', error);
          this.errors = {
            general: 'An unexpected error occurred. Please try again.'
          };
        } finally {
          this.isSubmitting = false;
          console.groupEnd();
        }
      },

      generateSlug() {
        if (this.form.title) {
          this.form.slug = this.form.title
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        }
      },

      handleFeaturedImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
          this.form.image = file;
        }
      }
    };
  }
</script>