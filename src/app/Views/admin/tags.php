<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <?= view('admin/layout/sidebar', ['currentPage' => 'tags']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
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
                        <input type="text" placeholder="Search tags..."
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <?php foreach ($tags as $tag): ?>
                    <span class="group inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm transition cursor-pointer"
                          style="background-color: <?= esc($tag->color ?? '#3b82f6') ?>20; color: <?= esc($tag->color ?? '#60a5fa') ?>">
                        <?= esc($tag->name) ?>
                        <button type="button" class="hover:text-white transition edit-tag-btn"
                            data-modal-toggle="editTagModal"
                            data-id="<?= $tag->id ?>"
                            data-name="<?= esc($tag->name) ?>"
                            data-slug="<?= esc($tag->slug) ?>"
                            data-color="<?= esc($tag->color ?? '') ?>"><i class="fas fa-pen text-xs"></i></button>
                        <form method="post" action="<?= site_url('/admin/tags/' . $tag->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="hover:text-red-400 transition"><i class="fas fa-xmark text-xs"></i></button>
                        </form>
                    </span>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500"><?= count($tags) ?> total</p>
                </div>

                <div class="mt-6 bg-gray-800 rounded-xl border border-gray-700 p-5">
                    <h3 class="text-white font-semibold text-sm mb-4">Add New Tag</h3>
                    <form method="post" action="<?= site_url('/admin/tags') ?>">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="tag-name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                                <input type="text" id="tag-name" name="name" placeholder="Tag name" required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                            <div>
                                <label for="tag-slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                                <input type="text" id="tag-slug" name="slug" placeholder="auto-generated"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                <p class="text-xs text-gray-500 mt-1">Leave empty to auto-generate.</p>
                            </div>
                            <div>
                                <label for="tag-color" class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                                <div class="flex gap-2">
                                    <input type="color" id="tag-color" name="color" value="#3b82f6"
                                        class="w-10 h-10 rounded cursor-pointer bg-gray-700 border border-gray-600" />
                                    <input type="text" id="tag-color-hex" placeholder="#3b82f6"
                                        class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                </div>
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

    <div id="editTagModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center p-4">
        <div class="bg-gray-800 rounded-xl border border-gray-700 w-full max-w-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-white font-semibold">Edit Tag</h3>
                <button type="button" class="text-gray-500 hover:text-white transition" data-modal-close="editTagModal"><i class="fas fa-times"></i></button>
            </div>
            <form method="post" action="" id="editTagForm" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="edit-tag-name" class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                    <input type="text" id="edit-tag-name" name="name" placeholder="Tag name" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                </div>
                <div>
                    <label for="edit-tag-slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                    <input type="text" id="edit-tag-slug" name="slug" placeholder="auto-generated"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                </div>
                <div>
                    <label for="edit-tag-color" class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                    <div class="flex gap-2">
                        <input type="color" id="edit-tag-color" name="color"
                            class="w-10 h-10 rounded cursor-pointer bg-gray-700 border border-gray-600" />
                        <input type="text" id="edit-tag-color-hex" placeholder="#3b82f6"
                            class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Update Tag</button>
                    <button type="button" class="bg-gray-700 text-gray-300 font-medium px-6 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm" data-modal-close="editTagModal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('editTagModal');
        const form = document.getElementById('editTagForm');
        const nameInput = document.getElementById('edit-tag-name');
        const slugInput = document.getElementById('edit-tag-slug');
        const colorInput = document.getElementById('edit-tag-color');
        const colorHexInput = document.getElementById('edit-tag-color-hex');

        function syncColor(picker, text) {
            picker.addEventListener('input', function() { text.value = this.value; });
            text.addEventListener('input', function() {
                if (/^#[0-9a-f]{6}$/i.test(this.value)) picker.value = this.value;
            });
        }
        syncColor(colorInput, colorHexInput);

        const addColorInput = document.getElementById('tag-color');
        const addColorHexInput = document.getElementById('tag-color-hex');
        if (addColorInput && addColorHexInput) syncColor(addColorInput, addColorHexInput);

        function openModal(btn) {
            form.action = '/admin/tags/' + btn.dataset.id;
            nameInput.value = btn.dataset.name || '';
            slugInput.value = btn.dataset.slug || '';
            const c = btn.dataset.color || '#3b82f6';
            colorInput.value = c;
            colorHexInput.value = c;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        document.querySelectorAll('[data-modal-toggle="editTagModal"]').forEach(function(btn) {
            btn.addEventListener('click', function() { openModal(this); });
        });

        document.querySelectorAll('[data-modal-close="editTagModal"]').forEach(function(btn) {
            btn.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        const tagNameInput = document.getElementById('tag-name');
        const tagSlugInput = document.getElementById('tag-slug');
        if (tagNameInput && tagSlugInput) {
            tagNameInput.addEventListener('blur', function() {
                if (!tagSlugInput.value) {
                    tagSlugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
                }
            });
        }
    });
    </script>
</body>
</html>