<?= view('layout/header', ['title' => 'Articles - Shaik Obydullah', 'metaKeywords' => 'articles, tutorials, software engineer, Laravel, Next.js, MySQL', 'activeNav' => 'articles']) ?>

<section class="pt-28 pb-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Articles</h2>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button data-filter="all" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-lime-500 text-gray-900">All</button>
            <button data-filter="UML" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">UML</button>
            <button data-filter="Laravel" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Laravel</button>
            <button data-filter="Next.js" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Next.js</button>
            <button data-filter="MySQL" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">MySQL</button>
            <button data-filter="Tutorial" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Tutorial</button>
            <button data-filter="React" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">React</button>
            <button data-filter="Vue.js" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Vue.js</button>
            <button data-filter="API" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">API</button>
        </div>

        <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php for ($i = 1; $i <= 9; $i++): ?>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="Laravel,Tutorial">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Tutorial</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Article Title <?= $i ?></h3>
                    <p class="text-gray-300 mb-4">Article description goes here.</p>
                    <a href="#" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <?php endfor; ?>
        </div>
    </div>
</section>

<?= view('layout/footer', ['extraScripts' => '
<script>
const filterBtns = document.querySelectorAll(".filter-btn");
const articleCards = document.querySelectorAll(".article-card");
filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        filterBtns.forEach((b) => { b.classList.remove("bg-lime-500", "text-gray-900"); b.classList.add("bg-gray-700", "text-white"); });
        btn.classList.remove("bg-gray-700", "text-white");
        btn.classList.add("bg-lime-500", "text-gray-900");
        const activeFilter = btn.dataset.filter;
        articleCards.forEach((card) => {
            const tags = card.dataset.tags;
            if (activeFilter === "all" || tags.includes(activeFilter)) card.classList.remove("hidden");
            else card.classList.add("hidden");
        });
    });
});
</script>
']) ?>
