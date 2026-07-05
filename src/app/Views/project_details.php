<?= view('layout/header', ['title' => esc($project->title) . ' - Shaik Obydullah', 'activeNav' => 'projects']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen overflow-x-hidden">
    <div class="w-full max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1 min-w-0">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="/" class="hover:text-lime-500 transition">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/projects" class="hover:text-lime-500 transition">Projects</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-300"><?= esc($project->title) ?></span>
                </nav>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($project->title) ?></h1>
                <div class="flex items-center text-gray-400 text-sm mb-8 flex-wrap gap-x-4">
                    <span><i class="far fa-calendar-alt mr-2"></i><?= date('M j, Y', strtotime($project->created_at)) ?></span>
                    <span><i class="fas fa-code mr-2"></i><?= esc($project->category ?? 'Project') ?></span>
                </div>
                <?php if ($project->featured_image): ?>
                <img src="<?= esc($project->featured_image) ?>" alt="<?= esc($project->title) ?>" class="w-full h-72 md:h-96 object-cover rounded-xl mb-8" />
                <?php endif; ?>
                <div class="prose prose-invert max-w-none">
                    <?= $project->description ?>
                </div>
            </div>
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Project Info</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between"><span class="text-gray-400">Category</span><span class="text-white"><?= esc($project->category ?? 'N/A') ?></span></li>
                            <?php if ($project->url): ?>
                            <li class="flex justify-between"><span class="text-gray-400">Live URL</span><a href="<?= esc($project->url) ?>" target="_blank" class="text-lime-500 hover:text-lime-400 truncate max-w-[160px]"><?= esc($project->url) ?></a></li>
                            <?php endif; ?>
                            <?php if ($project->github_url): ?>
                            <li class="flex justify-between"><span class="text-gray-400">GitHub</span><a href="<?= esc($project->github_url) ?>" target="_blank" class="text-lime-500 hover:text-lime-400 truncate max-w-[160px]"><?= esc($project->github_url) ?></a></li>
                            <?php endif; ?>
                            <?php if ($project->status): ?>
                            <li class="flex justify-between"><span class="text-gray-400">Status</span><span class="text-lime-500"><?= esc(ucfirst($project->status)) ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
