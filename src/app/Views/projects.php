<?= view('layout/header', ['title' => 'Projects - Shaik Obydullah', 'metaKeywords' => 'portfolio, projects, software engineer, Laravel, Next.js, MySQL', 'activeNav' => 'projects']) ?>

<section class="pt-28 pb-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">My Projects</h2>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button data-filter="all" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-lime-500 text-gray-900">All</button>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                <button data-filter="<?= esc($cat->name) ?>" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600"><?= esc($cat->name) ?></button>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag): ?>
                <button data-filter="<?= esc($tag->name) ?>" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600"><?= esc($tag->name) ?></button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="<?= esc($project->tags_str ?? '') ?>">
                    <img src="<?= esc($project->featured_image ?? 'https://placehold.co/400x200/4A5568/FFFFFF/png?text=' . urlencode($project->title)) ?>"
                         alt="<?= esc($project->title) ?>" class="w-full h-48 object-cover" />
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($project->category_name ?? 'Project') ?></span>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2"><?= esc($project->title) ?></h3>
                        <p class="text-gray-300 mb-4"><?= esc($project->excerpt ?? $project->description ?? '') ?></p>
                        <a href="/projects/<?= esc($project->slug) ?>" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-500 py-12">No projects published yet.</div>
            <?php endif; ?>
        </div>
        <?php if ($pager): ?>
        <div class="mt-10 flex justify-center"><?= $pager->links() ?></div>
        <?php endif; ?>
    </div>
</section>

<?= view('layout/footer', ['extraScripts' => '
<script>
const filterBtns = document.querySelectorAll(".filter-btn");
const projectCards = document.querySelectorAll(".project-card");
filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        filterBtns.forEach((b) => { b.classList.remove("bg-lime-500", "text-gray-900"); b.classList.add("bg-gray-700", "text-white"); });
        btn.classList.remove("bg-gray-700", "text-white");
        btn.classList.add("bg-lime-500", "text-gray-900");
        const activeFilter = btn.dataset.filter;
        projectCards.forEach((card) => {
            const tags = card.dataset.tags;
            if (activeFilter === "all" || tags.includes(activeFilter)) card.classList.remove("hidden");
            else card.classList.add("hidden");
        });
    });
});
</script>
']) ?>
