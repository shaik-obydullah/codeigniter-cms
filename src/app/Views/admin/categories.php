<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'categories', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>
                <?php if (session('errors')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= implode('<br>', session('errors')) ?></div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-search text-sm"></i></span>
                        <input type="text" placeholder="Search categories..."
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($categories as $category): ?>
                    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5 hover:border-lime-500/50 transition group">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-600/30 rounded-lg flex items-center justify-center">
                                    <i class="<?= esc($category->icon ?? 'fas fa-folder') ?> text-gray-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium text-sm"><?= esc($category->name) ?></h3>
                                    <p class="text-xs text-gray-500"><?= (int) ($category->article_count ?? 0) ?> articles</p>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-lime-400 hover:bg-gray-700 rounded-lg transition" title="Edit"
                                    data-modal-toggle="editCategoryModal"
                                    data-id="<?= $category->id ?>"
                                    data-name="<?= esc($category->name) ?>"
                                    data-slug="<?= esc($category->slug) ?>"
                                    data-icon="<?= esc($category->icon ?? '') ?>"
                                    data-description="<?= esc($category->description ?? '') ?>"><i class="fas fa-pen text-xs"></i></button>
                                <form method="post" action="<?= site_url('/dashboard/categories/' . $category->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 hover:bg-gray-700 rounded-lg transition" title="Delete"><i class="fas fa-trash text-xs"></i></button>
                                </form>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500"><?= esc($category->description ?? '') ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500"><?= count($categories) ?> total</p>
                </div>

                <div class="mt-6 bg-gray-800 rounded-xl border border-gray-700 p-5">
                    <h3 class="text-white font-semibold text-sm mb-4">Add New Category</h3>
                    <form method="post" action="<?= site_url('/dashboard/categories') ?>">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cat-icon" class="block text-sm font-medium text-gray-300 mb-1.5">Icon</label>
                                <input type="text" id="cat-icon" name="icon" placeholder="fas fa-folder"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                <p class="text-xs text-gray-500 mt-1">e.g. <code class="text-lime-400">fas fa-code</code>, <code class="text-lime-400">fas fa-database</code></p>
                            </div>
                            <div>
                                <label for="cat-name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                                <input type="text" id="cat-name" name="name" placeholder="Category name" required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                            <div>
                                <label for="cat-slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                                <input type="text" id="cat-slug" name="slug" placeholder="auto-generated"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate from name.</p>
                            </div>
                            <div>
                                <label for="cat-description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                                <textarea id="cat-description" name="description" rows="1" placeholder="Description (optional)"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"></textarea>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-4">
                            <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Create</button>
                            <button type="reset" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Reset</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <div id="editCategoryModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl border border-gray-700 w-full max-w-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-white font-semibold">Edit Category</h3>
                <button type="button" class="text-gray-500 hover:text-white transition" data-modal-close="editCategoryModal"><i class="fas fa-times"></i></button>
            </div>
            <form method="post" action="" id="editCategoryForm" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="edit-cat-icon" class="block text-sm font-medium text-gray-300 mb-1.5">Icon</label>
                    <input type="text" id="edit-cat-icon" name="icon" placeholder="fas fa-folder"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                </div>
                <div>
                    <label for="edit-cat-name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                    <input type="text" id="edit-cat-name" name="name" placeholder="Category name" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                </div>
                <div>
                    <label for="edit-cat-slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                    <input type="text" id="edit-cat-slug" name="slug" placeholder="auto-generated"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                </div>
                <div>
                    <label for="edit-cat-description" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                    <textarea id="edit-cat-description" name="description" rows="2" placeholder="Description (optional)"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"></textarea>
                </div>
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Update Category</button>
                    <button type="button" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm" data-modal-close="editCategoryModal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('editCategoryModal');
        const form = document.getElementById('editCategoryForm');
        const nameInput = document.getElementById('edit-cat-name');
        const slugInput = document.getElementById('edit-cat-slug');
        const iconInput = document.getElementById('edit-cat-icon');
        const descInput = document.getElementById('edit-cat-description');

        function openModal(btn) {
            form.action = '/dashboard/categories/' + btn.dataset.id;
            nameInput.value = btn.dataset.name || '';
            slugInput.value = btn.dataset.slug || '';
            iconInput.value = btn.dataset.icon || '';
            descInput.value = btn.dataset.description || '';
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        document.querySelectorAll('[data-modal-toggle="editCategoryModal"]').forEach(function(btn) {
            btn.addEventListener('click', function() { openModal(this); });
        });

        document.querySelectorAll('[data-modal-close="editCategoryModal"]').forEach(function(btn) {
            btn.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        const catNameInput = document.getElementById('cat-name');
        const catSlugInput = document.getElementById('cat-slug');
        if (catNameInput && catSlugInput) {
            catNameInput.addEventListener('blur', function() {
                if (!catSlugInput.value) {
                    catSlugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
                }
            });
        }
    });
    </script>
<?= view('admin/layout/footer') ?>