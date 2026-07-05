<?= view('layout/header', ['title' => esc($article->title) . ' - Shaik Obydullah', 'metaKeywords' => 'articles, tutorials', 'activeNav' => 'articles']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen overflow-x-hidden">
    <div class="w-full max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1 min-w-0">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="/" class="hover:text-lime-500 transition">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/articles" class="hover:text-lime-500 transition">Articles</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-300"><?= esc($article->title) ?></span>
                </nav>
                <div class="flex flex-wrap gap-2 mb-4">
                    <?php if (!empty($articleCats)): ?>
                        <?php foreach ($articleCats as $cat): ?>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($cat->name) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (!empty($articleTags)): ?>
                        <?php foreach ($articleTags as $tag): ?>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($tag->name) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($article->title) ?></h1>
                <div class="flex items-center text-gray-400 text-sm mb-8 flex-wrap gap-x-4">
                    <span><i class="far fa-calendar-alt mr-2"></i><?= date('M j, Y', strtotime($article->published_at ?? $article->created_at)) ?></span>
                    <span><i class="far fa-user mr-2"></i>Shaik Obydullah</span>
                </div>
                <?php if ($article->featured_image): ?>
                <img src="<?= esc($article->featured_image) ?>" alt="<?= esc($article->title) ?>" class="w-full h-72 md:h-96 object-cover rounded-xl mb-8" />
                <?php endif; ?>
                <div class="prose prose-invert max-w-none">
                    <?= $article->content ?>
                </div>
                <div class="flex items-center gap-4 mt-10 pt-8 border-t border-gray-700">
                    <span class="text-gray-400 font-medium">Share:</span>
                    <a href="https://linkedin.com/share?url=<?= urlencode(current_url()) ?>" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in text-xl"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f text-xl"></i></a>
                </div>
            </div>
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Search</h3>
                        <div class="relative">
                            <input type="text" placeholder="Search articles..." class="w-full bg-gray-700 text-white rounded-lg px-4 py-2.5 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-400" />
                            <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <?php foreach ($categories as $cat): ?>
                            <li><a href="/articles?category=<?= esc($cat->slug) ?>" class="text-gray-400 hover:text-lime-500 transition flex justify-between"><span><?= esc($cat->name) ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (!empty($recentPosts)): ?>
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Recent Articles</h3>
                        <ul class="space-y-4">
                            <?php foreach ($recentPosts as $recent): ?>
                            <li>
                                <a href="/articles/<?= esc($recent->slug) ?>" class="group flex gap-3">
                                    <div>
                                        <h4 class="text-sm font-medium text-white group-hover:text-lime-500 transition leading-tight"><?= esc($recent->title) ?></h4>
                                        <span class="text-xs text-gray-500"><?= date('M j, Y', strtotime($recent->published_at ?? $recent->created_at)) ?></span>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($tags)): ?>
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag): ?>
                            <a href="/articles?tag=<?= esc($tag->slug) ?>" class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm hover:bg-lime-500 hover:text-gray-900 transition"><?= esc($tag->name) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
