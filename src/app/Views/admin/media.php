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
        <?= view('admin/layout/sidebar', ['currentPage' => 'media']) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <form method="get" action="<?= site_url('/dashboard/media') ?>" class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-search text-sm"></i></span>
                        <input type="text" name="search" placeholder="Search media..." value="<?= esc($search ?? '') ?>"
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </form>
                    <form method="post" action="<?= site_url('/dashboard/media/upload') ?>" enctype="multipart/form-data" id="uploadForm">
                        <?= csrf_field() ?>
                        <label class="flex items-center gap-2 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm shrink-0 cursor-pointer">
                            <i class="fas fa-upload"></i> Upload Files
                            <input type="file" name="files[]" multiple accept="image/*" class="hidden" id="uploadInput" onchange="this.form.submit()" />
                        </label>
                    </form>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <?php if (empty($mediaItems)): ?>
                        <div class="flex flex-col items-center justify-center py-20 text-gray-500">
                            <i class="fas fa-image text-5xl mb-4"></i>
                            <p class="text-lg font-medium">No media found</p>
                            <p class="text-sm mt-1">Upload images to get started.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 p-5">
                            <?php foreach ($mediaItems as $item): ?>
                                <div class="group relative bg-gray-700/50 rounded-lg overflow-hidden border border-gray-700 hover:border-lime-500/50 transition">
                                    <img src="<?= base_url($item->path) ?>" alt="<?= esc($item->alt_text ?: $item->original_name) ?>"
                                        class="w-full aspect-square object-cover cursor-pointer"
                                        onclick="insertToEditor('<?= base_url($item->path) ?>')" />
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                                        <button onclick="insertToEditor('<?= base_url($item->path) ?>')" class="p-2 bg-white/20 rounded-lg hover:bg-white/30 transition text-white" title="Insert into editor">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                        <form method="post" action="<?= site_url('/dashboard/media/' . $item->id . '/delete') ?>" onsubmit="return confirm('Delete this file?')" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-2 bg-red-500/20 rounded-lg hover:bg-red-500/30 transition text-red-400" title="Delete">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="p-2 truncate text-xs text-gray-400"><?= esc($item->original_name) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

<script>
function insertToEditor(url) {
    if (window.opener && window.opener.tinymce) {
        window.opener.tinymce.activeEditor.insertContent('<img src="' + url + '" alt="" />');
        window.close();
    }
}
</script>
</body>
</html>
