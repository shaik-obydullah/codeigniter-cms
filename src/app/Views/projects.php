<?= view('layout/header', ['title' => 'Projects - Shaik Obydullah', 'metaKeywords' => 'portfolio, projects, software engineer, Laravel, Next.js, MySQL', 'activeNav' => 'projects']) ?>

<section class="pt-28 pb-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">My Projects</h2>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-3/4">
                <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if (!empty($projects)): ?>
                        <?php foreach ($projects as $project): ?>
                        <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform"
                             data-category="<?= esc($project->category_name ?? '') ?>"
                             data-tags="<?= esc($project->tags_str ?? '') ?>">
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
                <div id="pagination" class="mt-10 flex justify-center"><?= $pager->links() ?></div>
                <?php endif; ?>
            </div>

            <aside class="lg:w-1/4">
                <div class="bg-gray-800 rounded-lg p-6 sticky top-28 space-y-6">
                    <div>
                        <h3 class="text-white font-semibold mb-3">Categories</h3>
                        <div class="space-y-1" id="category-filters">
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                <label class="flex items-center gap-2 px-3 py-1.5 rounded-lg cursor-pointer transition text-sm hover:bg-gray-700/50 text-gray-300">
                                    <input type="checkbox" value="<?= esc($cat->name) ?>" class="peer hidden cat-filter">
                                    <span class="w-2 h-2 rounded-full border border-gray-500 peer-checked:bg-lime-500 peer-checked:border-lime-500 transition shrink-0"></span>
                                    <span class="peer-checked:text-white transition"><?= esc($cat->name) ?></span>
                                </label>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold mb-3">Tags</h3>
                        <div class="space-y-1" id="tag-filters">
                            <?php if (!empty($tags)): ?>
                                <?php foreach ($tags as $tag): ?>
                                <label class="flex items-center gap-2 px-3 py-1.5 rounded-lg cursor-pointer transition text-sm hover:bg-gray-700/50 text-gray-300">
                                    <input type="checkbox" value="<?= esc($tag->name) ?>" class="peer hidden tag-filter">
                                    <span class="w-2 h-2 rounded-full border border-gray-500 peer-checked:bg-lime-500 peer-checked:border-lime-500 transition shrink-0"></span>
                                    <span class="peer-checked:text-white transition"><?= esc($tag->name) ?></span>
                                </label>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer', ['extraScripts' => '
<script>
const projectCards = document.querySelectorAll(".project-card");

function applyFilters() {
    const selectedCats = [...document.querySelectorAll(".cat-filter:checked")].map(cb => cb.value);
    const selectedTags = [...document.querySelectorAll(".tag-filter:checked")].map(cb => cb.value);
    const hasCatFilter = selectedCats.length > 0;
    const hasTagFilter = selectedTags.length > 0;

    projectCards.forEach((card) => {
        const projectCats = (card.dataset.category || "").split(", ");
        const projectTags = (card.dataset.tags || "").split(", ");
        const catMatch = !hasCatFilter || projectCats.some(c => selectedCats.includes(c));
        const tagMatch = !hasTagFilter || projectTags.some(t => selectedTags.includes(t));
        card.classList.toggle("hidden", !(catMatch && tagMatch));
    });
}

const pagination = document.getElementById("pagination");

document.querySelectorAll(".cat-filter, .tag-filter").forEach(cb => {
    cb.addEventListener("change", () => {
        applyFilters();
        const hasFilter = [...document.querySelectorAll(".cat-filter:checked, .tag-filter:checked")].length > 0;
        if (pagination) pagination.classList.toggle("hidden", hasFilter);
    });
});
</script>
']) ?>
