<?= view('layout/header', ['title' => 'Articles - Shaik Obydullah', 'metaKeywords' => 'articles, tutorials, software engineer, Laravel, Next.js, MySQL', 'activeNav' => 'articles']) ?>

<section class="pt-28 pb-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Articles</h2>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-3/4">
                <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                    <article
                        class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform"
                        data-category="<?= esc($article->category_name ?? '') ?>"
                        data-tags="<?= esc($article->tags_str ?? '') ?>">
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm"><?= esc($article->category_name ?? 'Article') ?></span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2"><?= esc($article->title) ?></h3>
                            <p class="text-gray-300 mb-4"><?= esc($article->excerpt ?? '') ?></p>
                            <a href="/articles/<?= esc($article->slug) ?>"
                                class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More
                                &rarr;</a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="col-span-full text-center text-gray-500 py-12">No articles published yet.</div>
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
                            <label
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg cursor-pointer transition text-sm hover:bg-gray-700/50 text-gray-300">
                                <input type="checkbox" value="<?= esc($cat->name) ?>" class="peer hidden cat-filter">
                                <span
                                    class="w-2 h-2 rounded-full border border-gray-500 peer-checked:bg-lime-500 peer-checked:border-lime-500 transition shrink-0"></span>
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
                            <label
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg cursor-pointer transition text-sm hover:bg-gray-700/50 text-gray-300">
                                <input type="checkbox" value="<?= esc($tag->name) ?>" class="peer hidden tag-filter">
                                <span
                                    class="w-2 h-2 rounded-full border border-gray-500 peer-checked:bg-lime-500 peer-checked:border-lime-500 transition shrink-0"></span>
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

<script id="all-articles-data" type="application/json">
<?= json_encode($allArticles ?? []) ?>
</script>

<?= view('layout/footer', ['extraScripts' => '
<script>
const grid = document.getElementById("articles-grid");
const pagination = document.getElementById("pagination");
const allArticles = JSON.parse(document.getElementById("all-articles-data").textContent);

function renderCards(items) {
    grid.innerHTML = items.length
        ? items.map(a => `<article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-category="${escHtml(a.category_name)}" data-tags="${escHtml(a.tags_str)}"><div class="p-6"><div class="flex flex-wrap gap-2 mb-4"><span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">${escHtml(a.category_name || "Article")}</span></div><h3 class="text-2xl font-bold text-white mb-2">${escHtml(a.title)}</h3><p class="text-gray-300 mb-4">${escHtml(a.excerpt || "")}</p><a href="/articles/${escHtml(a.slug)}" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a></div></article>`).join("")
        : `<div class="col-span-full text-center text-gray-500 py-12">No articles match your filters.</div>`;
}

function escHtml(str) {
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
}

function applyFilters() {
    const selectedCats = [...document.querySelectorAll(".cat-filter:checked")].map(cb => cb.value);
    const selectedTags = [...document.querySelectorAll(".tag-filter:checked")].map(cb => cb.value);
    const hasCatFilter = selectedCats.length > 0;
    const hasTagFilter = selectedTags.length > 0;

    if (!hasCatFilter && !hasTagFilter) {
        location.reload();
        return;
    }

    const filtered = allArticles.filter(a => {
        const cats = (a.category_name || "").split(", ");
        const tags = (a.tags_str || "").split(", ");
        const catMatch = !hasCatFilter || cats.some(c => selectedCats.includes(c));
        const tagMatch = !hasTagFilter || tags.some(t => selectedTags.includes(t));
        return catMatch && tagMatch;
    });

    renderCards(filtered);
    if (pagination) pagination.classList.add("hidden");
}

document.querySelectorAll(".cat-filter, .tag-filter").forEach(cb => {
    cb.addEventListener("change", applyFilters);
});
</script>
']) ?>