<?= view('layout/header', ['title' => 'Projects - Shaik Obydullah', 'metaKeywords' => 'portfolio, projects, software engineer, Laravel, Next.js, MySQL', 'activeNav' => 'projects']) ?>

<section class="pt-28 pb-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">My Projects</h2>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button data-filter="all" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-lime-500 text-gray-900">All</button>
            <button data-filter="Laravel" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Laravel</button>
            <button data-filter="Next.js" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Next.js</button>
            <button data-filter="MySQL" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">MySQL</button>
            <button data-filter="React" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">React</button>
            <button data-filter="Vue.js" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Vue.js</button>
            <button data-filter="Livewire" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Livewire</button>
            <button data-filter="API" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">API</button>
            <button data-filter="Tailwind" class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Tailwind</button>
        </div>

        <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php for ($i = 1; $i <= 9; $i++): ?>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Laravel,Next.js">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Project+<?= $i ?>" alt="Project <?= $i ?>" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Project <?= $i ?></h3>
                    <p class="text-gray-300 mb-4">A sample project description goes here.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Next.js</span>
                    </div>
                    <a href="#" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
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
