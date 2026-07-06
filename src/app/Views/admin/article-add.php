<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.tiny.cloud/1/aj9gbow0nmvhy0xkztehf7xdc6xk9pq13ojnykygqkuncalz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <?= view('admin/layout/sidebar', ['currentPage' => 'articles']) ?>

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

                <div class="flex items-center gap-2 text-sm text-gray-500 mb-5">
                    <a href="<?= site_url('/dashboard/articles') ?>" class="hover:text-lime-400 transition">Articles</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-gray-300"><?= isset($editArticle) ? 'Edit Article' : 'New Article' ?></span>
                </div>

                <form method="post" action="<?= site_url('/dashboard/articles' . (isset($editArticle) ? '/' . $editArticle->id : '')) ?>" class="grid grid-cols-1 lg:grid-cols-3 gap-6" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <?php if (isset($editArticle)): ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-1.5">Article Title</label>
                            <input type="text" id="title" name="title" value="<?= old('title', $editArticle->title ?? '') ?>" placeholder="Enter article title"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-sm">/articles/</span>
                                <input type="text" id="slug" name="slug" value="<?= old('slug', $editArticle->slug ?? '') ?>" placeholder="getting-started-with-laravel"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-[76px] pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="content" class="block text-sm font-medium text-gray-300 mb-1.5">Content</label>
                            <textarea id="content" name="content"><?= old('content', $editArticle->content ?? '') ?></textarea>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="excerpt" class="block text-sm font-medium text-gray-300 mb-1.5">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Brief description of the article..."
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"><?= old('excerpt', $editArticle->excerpt ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Publish</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Status</label>
                                    <select name="status"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent">
                                        <option value="draft" <?= (old('status', $editArticle->status ?? 'draft') == 'draft') ? 'selected' : '' ?>>Draft</option>
                                        <option value="published" <?= (old('status', $editArticle->status ?? 'draft') == 'published') ? 'selected' : '' ?>>Published</option>
                                        <option value="scheduled" <?= (old('status', $editArticle->status ?? 'draft') == 'scheduled') ? 'selected' : '' ?>>Scheduled</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Publish Date</label>
                                    <input type="date" name="published_at" value="<?= old('published_at', isset($editArticle->published_at) ? date('Y-m-d', strtotime($editArticle->published_at)) : date('Y-m-d')) ?>"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Serial</label>
                                    <input type="number" name="serial" value="<?= old('serial', $editArticle->serial ?? 0) ?>" min="0"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                            </div>
                            <div class="flex gap-2 mt-4">
                                <button type="submit" class="flex-1 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save</button>
                                <button type="submit" name="save_draft" value="1" class="flex-1 bg-gray-700 text-gray-300 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Save Draft</button>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Categories</h3>
                            <div class="space-y-2">
                                <?php foreach ($categories as $cat): ?>
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="<?= $cat->id ?>"
                                        <?= in_array($cat->id, $articleCategories ?? []) ? 'checked' : '' ?>
                                        class="w-4 h-4 rounded bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                    <span class="text-sm text-gray-300"><?= esc($cat->name) ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Tags</h3>
                            <div class="space-y-2">
                                <?php foreach ($tags as $tag): ?>
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>"
                                        <?= in_array($tag->id, $articleTags ?? []) ? 'checked' : '' ?>
                                        class="w-4 h-4 rounded bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                    <span class="text-sm text-gray-300"><?= esc($tag->name) ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Featured Image</h3>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-lime-500 transition cursor-pointer" id="featuredImageBox" onclick="document.getElementById('featuredImageInput').click()">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-500 mb-2"></i>
                                <p class="text-sm text-gray-500">Click to upload</p>
                                <p class="text-xs text-gray-600 mt-1">PNG, JPG up to 2MB</p>
                            </div>
                            <input type="file" id="featuredImageInput" name="featured_image" accept="image/png,image/jpeg,image/gif,image/webp" class="hidden" onchange="previewFeaturedImage(this)" />
                            <?php if (isset($editArticle) && $editArticle->featured_image): ?>
                            <div class="mt-3 relative inline-block">
                                <img src="<?= base_url($editArticle->featured_image) ?>" alt="Featured" class="w-full h-32 object-cover rounded-lg" />
                                <button type="button" onclick="removeFeaturedImage(this)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-500">&times;</button>
                            </div>
                            <input type="hidden" name="existing_featured_image" value="<?= $editArticle->featured_image ?>" />
                            <?php endif; ?>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">SEO Meta</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Meta Title</label>
                                    <input type="text" name="meta_title" value="<?= old('meta_title', $editArticle->meta_title ?? '') ?>" placeholder="SEO title"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Meta Description</label>
                                    <textarea name="meta_description" rows="3" placeholder="SEO description"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"><?= old('meta_description', $editArticle->meta_description ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

<script>
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

(function() {
    let titleInput = document.getElementById('title');
    let slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            slugInput.value = slugify(this.value);
        });
    }
})();

function previewFeaturedImage(input) {
    let box = document.getElementById('featuredImageBox');
    let container = box.parentElement;
    let existing = container.querySelector('.mt-3');

    if (existing) existing.remove();

    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.createElement('div');
            preview.className = 'mt-3 relative inline-block';
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-32 object-cover rounded-lg" />' +
                '<button type="button" onclick="this.parentElement.remove(); document.getElementById(\'featuredImageInput\').value=\'\'" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-500">&times;</button>';
            container.appendChild(preview);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeFeaturedImage(btn) {
    btn.closest('.mt-3').remove();
    let hidden = document.querySelector('input[name="existing_featured_image"]');
    if (hidden) hidden.value = '';
}

tinymce.init({
    selector: '#content',
    plugins: 'code table link image lists',
    toolbar: 'undo redo | styles | bold italic underline | bullist numlist | alignleft aligncenter alignright | link image | code',
    skin: 'oxide-dark',
    content_css: 'dark',
    height: 500,
    branding: false,
    promotion: false,
    file_picker_callback: function (callback, value, meta) {
        if (meta.filetype === 'image') {
            let url = '<?= site_url('/dashboard/media/browse') ?>';
            fetch(url)
                .then(r => r.json())
                .then(items => {
                    let picker = window.open('', 'mediaPicker', 'width=900,height=600');
                    let html = '<!DOCTYPE html><html><head><title>Media Library</title>';
                    html += '<script src=\"https://cdn.tailwindcss.com\"><\/script>';
                    html += '<style>body{background:#111;color:#ccc;padding:20px;}';
                    html += '.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;}';
                    html += '.item{border:1px solid #333;border-radius:8px;overflow:hidden;cursor:pointer;transition:.2s;}';
                    html += '.item:hover{border-color:#84cc16;}.item img{width:100%;aspect-ratio:1;object-fit:cover;}';
                    html += '.item p{padding:6px 8px;font-size:12px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin:0;}</style><\/head><body>';
                    html += '<h2 class=\"text-lg font-semibold mb-4 text-white\">Select an Image</h2><div class=\"grid\">';
                    items.forEach(function(item) {
                        html += '<div class=\"item\" onclick=\"opener.tinymce.activeEditor.execCommand(\'mceInsertContent\',false,\'<img src=' + item.url + ' alt=\\\'\\\' />\');window.close();\">';
                        html += '<img src=\"' + item.url + '\" alt=\"\" /><p>' + item.name + '</p></div>';
                    });
                    html += '</div></body></html>';
                    picker.document.write(html);
                    picker.document.close();
                });
        }
    }
});
</script>
</body>
</html>
