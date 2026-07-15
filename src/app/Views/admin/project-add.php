<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'projects', 'unreadCount' => $unreadCount, 'user' => $user, 'extraHead' => '<script src="https://cdn.tiny.cloud/1/aj9gbow0nmvhy0xkztehf7xdc6xk9pq13ojnykygqkuncalz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>']) ?>
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
                    <a href="<?= site_url('/dashboard/projects') ?>" class="hover:text-lime-400 transition">Projects</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-gray-300"><?= isset($editProject) ? 'Edit Project' : 'New Project' ?></span>
                </div>

                <form method="post" action="<?= site_url('/dashboard/projects' . (isset($editProject) ? '/' . $editProject->id : '')) ?>" class="grid grid-cols-1 lg:grid-cols-3 gap-6" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <?php if (isset($editProject)): ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-1.5">Project Title</label>
                            <input type="text" id="title" name="title" value="<?= old('title', $editProject->title ?? '') ?>" placeholder="Enter project title"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="slug" class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-sm">/projects/</span>
                                <input type="text" id="slug" name="slug" value="<?= old('slug', $editProject->slug ?? '') ?>" placeholder="e-commerce-platform"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-[80px] pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="content" class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                            <textarea id="content" name="content"><?= old('content', $editProject->description ?? '') ?></textarea>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="excerpt" class="block text-sm font-medium text-gray-300 mb-1.5">Short Summary</label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Brief summary of the project..."
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"><?= old('excerpt', $editProject->excerpt ?? '') ?></textarea>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <label for="url" class="block text-sm font-medium text-gray-300 mb-1.5">Project URL</label>
                            <input type="url" id="url" name="url" value="<?= old('url', $editProject->url ?? '') ?>" placeholder="https://github.com/username/project"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
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
                                        <option value="draft" <?= (old('status', $editProject->status ?? 'draft') == 'draft') ? 'selected' : '' ?>>Draft</option>
                                        <option value="published" <?= (old('status', $editProject->status ?? 'draft') == 'published') ? 'selected' : '' ?>>Published</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Publish Date</label>
                                    <input type="date" name="published_at" value="<?= old('published_at', isset($editProject->published_at) ? date('Y-m-d', strtotime($editProject->published_at)) : date('Y-m-d')) ?>"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Serial</label>
                                    <input type="number" name="serial" value="<?= old('serial', $editProject->serial ?? 0) ?>" min="0"
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
                                        <?= in_array($cat->id, $projectCategories ?? []) ? 'checked' : '' ?>
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
                                        <?= in_array($tag->id, $projectTags ?? []) ? 'checked' : '' ?>
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
                            <?php if (isset($editProject) && $editProject->featured_image): ?>
                            <div class="mt-3 relative inline-block">
                                <img src="<?= base_url($editProject->featured_image) ?>" alt="Featured" class="w-full h-32 object-cover rounded-lg" />
                                <button type="button" onclick="removeFeaturedImage(this)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-500">&times;</button>
                            </div>
                            <input type="hidden" name="existing_featured_image" value="<?= $editProject->featured_image ?>" />
                            <?php endif; ?>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">SEO Meta</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Meta Title</label>
                                    <input type="text" name="meta_title" value="<?= old('meta_title', $editProject->meta_title ?? '') ?>" placeholder="SEO title"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Meta Description</label>
                                    <textarea name="meta_description" rows="3" placeholder="SEO description"
                                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-none"><?= old('meta_description', $editProject->meta_description ?? '') ?></textarea>
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
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | bullist numlist | alignleft aligncenter alignright alignjustify | link image | code | removeformat',
    skin: 'oxide-dark',
    content_css: 'dark',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; line-height: 1.8; color: #e5e5e5; background: #111827; padding: 16px; margin: 0; } body > *:first-child { margin-top: 0; }',
    height: 500,
    branding: false,
    promotion: false,
    entity_encoding: 'named',
    convert_urls: false,
    relative_urls: false,
    remove_script_host: false,
    document_base_url: '<?= site_url('/') ?>',
    block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Preformatted=pre; Blockquote=blockquote',
    formats: {
        bold: { inline: 'strong' },
        italic: { inline: 'em' },
        strikethrough: { inline: 'del' },
        underline: { inline: 'u' },
        h2: { block: 'h2', classes: '' },
        h3: { block: 'h3', classes: '' },
        h4: { block: 'h4', classes: '' },
        pre: { block: 'pre', classes: '', wrapper: true },
        blockquote: { block: 'blockquote', classes: '', wrapper: true },
        alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'left' } },
        aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'center' } },
        alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'right' } },
        alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', styles: { textAlign: 'justify' } }
    },
    style_formats: [
        { title: 'Headings', items: [
            { title: 'Heading 2', format: 'h2' },
            { title: 'Heading 3', format: 'h3' },
            { title: 'Heading 4', format: 'h4' }
        ]},
        { title: 'Blocks', items: [
            { title: 'Paragraph', format: 'p' },
            { title: 'Preformatted', format: 'pre' },
            { title: 'Blockquote', format: 'blockquote' }
        ]}
    ],
    valid_styles: {
        '*': 'text-align'
    },
    extended_valid_elements: 'img[class|src|border=0|alt|title|width|height]',
    invalid_styles: 'color font-family font-size background',
    forced_root_block: 'p',
    forced_root_block_attrs: { 'class': '' },
    remove_empty_nodes: true,
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
<?= view('admin/layout/footer') ?>
