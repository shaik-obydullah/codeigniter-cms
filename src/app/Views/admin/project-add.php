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
        <?= view('admin/layout/sidebar', ['currentPage' => 'projects']) ?>

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
                    <a href="<?= site_url('/dashboard/projects') ?>" class="hover:text-lime-400 transition">Projects</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-gray-300"><?= isset($editProject) ? 'Edit Project' : 'New Project' ?></span>
                </div>

                <form method="post" action="<?= site_url('/dashboard/projects' . (isset($editProject) ? '/' . $editProject->id : '')) ?>" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
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
                            <textarea id="content" name="content" rows="12" placeholder="Describe your project..."
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 resize-y"><?= old('content', $editProject->content ?? '') ?></textarea>
                            <p class="text-xs text-gray-500 mt-1.5">Supports Markdown formatting</p>
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
                            </div>
                            <div class="flex gap-2 mt-4">
                                <button type="submit" class="flex-1 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm">Save</button>
                                <button type="submit" name="save_draft" value="1" class="flex-1 bg-gray-700 text-gray-300 font-medium px-4 py-2.5 rounded-lg hover:bg-gray-600 transition text-sm">Save Draft</button>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Technologies</h3>
                            <div class="space-y-2">
                                <?php foreach ($technologies as $tech): ?>
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <input type="checkbox" name="technologies[]" value="<?= $tech->id ?>"
                                        <?= in_array($tech->id, $projectTechnologies ?? []) ? 'checked' : '' ?>
                                        class="w-4 h-4 rounded bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                                    <span class="text-sm text-gray-300"><?= esc($tech->name) ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
                            <h3 class="text-white font-semibold text-sm mb-3">Featured Image</h3>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-lime-500 transition cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-500 mb-2"></i>
                                <p class="text-sm text-gray-500">Click to upload</p>
                                <p class="text-xs text-gray-600 mt-1">PNG, JPG up to 2MB</p>
                            </div>
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

</body>
</html>
