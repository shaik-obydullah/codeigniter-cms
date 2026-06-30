<?= view('layout/header', ['title' => 'Project Details - Shaik Obydullah', 'activeNav' => 'projects']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1 min-w-0">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="/" class="hover:text-lime-500 transition">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/projects" class="hover:text-lime-500 transition">Projects</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-300">Project Title</span>
                </nav>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Project Title</h1>
                <div class="flex items-center text-gray-400 text-sm mb-8">
                    <span><i class="far fa-calendar-alt mr-2"></i>March 10, 2026</span>
                    <span class="mx-4">|</span>
                    <span><i class="fas fa-code mr-2"></i>Laravel</span>
                    <span class="mx-4">|</span>
                    <span><i class="far fa-user mr-2"></i>Shaik Obydullah</span>
                </div>
                <img src="https://placehold.co/1200x600/4A5568/FFFFFF/png?text=Project+Title" alt="Project Title" class="w-full h-72 md:h-96 object-cover rounded-xl mb-8" />
                <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed space-y-6">
                    <p class="text-lg">A full-featured project built with Laravel and MySQL.</p>
                    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Overview</h2>
                    <p>This project was designed to solve real-world problems with scalable solutions.</p>
                    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Key Features</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong class="text-white">Feature 1:</strong> Description here.</li>
                        <li><strong class="text-white">Feature 2:</strong> Description here.</li>
                    </ul>
                </div>
            </div>
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Project Info</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between"><span class="text-gray-400">Client</span><span class="text-white">Client Name</span></li>
                            <li class="flex justify-between"><span class="text-gray-400">Category</span><span class="text-white">Web App</span></li>
                            <li class="flex justify-between"><span class="text-gray-400">Timeline</span><span class="text-white">3 months</span></li>
                            <li class="flex justify-between"><span class="text-gray-400">Role</span><span class="text-white">Full Stack Dev</span></li>
                            <li class="flex justify-between"><span class="text-gray-400">Status</span><span class="text-lime-500">Live</span></li>
                        </ul>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Tech Stack</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                            <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                            <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Tailwind</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
