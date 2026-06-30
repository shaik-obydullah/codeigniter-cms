<?= view('layout/header', ['title' => 'Article Details - Shaik Obydullah', 'activeNav' => 'articles']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1 min-w-0">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="/" class="hover:text-lime-500 transition">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/articles" class="hover:text-lime-500 transition">Articles</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-300">Article Title</span>
                </nav>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Tutorial</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Article Title</h1>
                <div class="flex items-center text-gray-400 text-sm mb-8">
                    <span><i class="far fa-calendar-alt mr-2"></i>June 15, 2026</span>
                    <span class="mx-4">|</span>
                    <span><i class="far fa-clock mr-2"></i>5 min read</span>
                    <span class="mx-4">|</span>
                    <span><i class="far fa-user mr-2"></i>Shaik Obydullah</span>
                </div>
                <img src="https://placehold.co/1200x600/4A5568/FFFFFF/png?text=Article+Title" alt="Article Title" class="w-full h-72 md:h-96 object-cover rounded-xl mb-8" />
                <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed space-y-6">
                    <p class="text-lg">Article content goes here. This is a sample detailed article view.</p>
                    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Section 1</h2>
                    <p>Content for section 1.</p>
                    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Section 2</h2>
                    <p>Content for section 2.</p>
                    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Conclusion</h2>
                    <p>Conclusion content here.</p>
                </div>
                <div class="flex items-center gap-4 mt-10 pt-8 border-t border-gray-700">
                    <span class="text-gray-400 font-medium">Share:</span>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f text-xl"></i></a>
                </div>
            </div>
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-lime-500 transition flex justify-between"><span>Laravel</span><span class="text-gray-500">(2)</span></a></li>
                            <li><a href="#" class="text-gray-400 hover:text-lime-500 transition flex justify-between"><span>Next.js</span><span class="text-gray-500">(1)</span></a></li>
                            <li><a href="#" class="text-gray-400 hover:text-lime-500 transition flex justify-between"><span>MySQL</span><span class="text-gray-500">(1)</span></a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
