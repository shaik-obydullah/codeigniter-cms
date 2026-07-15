<?= view('layout/header', ['title' => esc($article->title) . ' - Shaik Obydullah', 'activeNav' => 'articles']) ?>

<section class="pt-28 pb-24 bg-gray-900 min-h-screen">
    <div class="w-full max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12">

            <!-- ==================== MAIN CONTENT ==================== -->
            <main class="flex-1 min-w-0">

                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
                    <a href="/" class="hover:text-lime-500 transition-colors">Home</a>
                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="/articles" class="hover:text-lime-500 transition-colors">Articles</a>
                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-300 truncate max-w-[200px]"><?= esc($article->title) ?></span>
                </nav>

                <!-- Category & Tag Pills -->
                <?php if (!empty($articleCats) || !empty($articleTags)): ?>
                <div class="flex flex-wrap gap-2 mb-5">
                    <?php foreach ($articleCats as $cat): ?>
                    <a href="/articles?category=<?= esc($cat->slug) ?>"
                        class="bg-lime-500/10 text-lime-400 border border-lime-500/20 px-3.5 py-1 rounded-full text-xs font-medium hover:bg-lime-500/20 transition-colors"><?= esc($cat->name) ?></a>
                    <?php endforeach; ?>
                    <?php foreach ($articleTags as $tag): ?>
                    <a href="/articles?tag=<?= esc($tag->slug) ?>"
                        class="bg-gray-800 text-gray-400 border border-gray-700 px-3.5 py-1 rounded-full text-xs font-medium hover:border-gray-500 hover:text-gray-300 transition-colors"><?= esc($tag->name) ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Title -->
                <h1 class="text-3xl md:text-[2.75rem] leading-tight font-extrabold text-white mb-5 tracking-tight">
                    <?= esc($article->title) ?></h1>

                <!-- Meta Row -->
                <div
                    class="flex items-center flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500 mb-8 pb-8 border-b border-gray-800">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?= date('M j, Y', strtotime($article->published_at ?? $article->created_at)) ?>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Shaik Obydullah
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?= ceil(str_word_count(strip_tags($article->content)) / 200) ?> min read
                    </span>
                </div>

                <!-- Featured Image -->
                <?php if ($article->featured_image): ?>
                <div class="mb-10 -mx-4 md:mx-0">
                    <img src="<?= esc($article->featured_image) ?>" alt="<?= esc($article->title) ?>"
                        class="w-full h-64 md:h-[28rem] object-cover rounded-2xl border border-gray-800" />
                </div>
                <?php endif; ?>

                <!-- Article Body -->
                <div class="prose prose-invert max-w-none">
                    <?= $article->content ?>
                </div>

                <!-- Social Sharing -->
                <div class="mt-14 pt-8 border-t border-gray-800">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <span class="text-sm font-medium text-gray-500">Share this article</span>
                        <div class="flex items-center gap-3">
                            <a href="https://linkedin.com/shareArticle?mini=true&url=<?= urlencode(current_url()) ?>&title=<?= urlencode($article->title) ?>"
                                target="_blank" rel="noopener"
                                class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:bg-[#0077b5]/10 hover:border-[#0077b5]/50 hover:text-[#0077b5] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($article->title) ?>"
                                target="_blank" rel="noopener"
                                class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:bg-[#1da1f2]/10 hover:border-[#1da1f2]/50 hover:text-[#1da1f2] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                                target="_blank" rel="noopener"
                                class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:bg-[#1877f2]/10 hover:border-[#1877f2]/50 hover:text-[#1877f2] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mt-14">
                    <div class="flex items-center gap-3 mb-8">
                        <h2 class="text-xl font-bold text-white">Comments</h2>
                        <?php if (!empty($comments)): ?>
                        <span
                            class="bg-gray-800 text-gray-400 text-xs font-medium px-2.5 py-1 rounded-full"><?= count($comments) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Flash Messages -->
                    <?php if (session('message')): ?>
                    <div
                        class="mb-5 px-4 py-3 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?= esc(session('message')) ?>
                    </div>
                    <?php endif; ?>
                    <?php if (session('errors')): ?>
                    <div
                        class="mb-5 px-4 py-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?= implode('<br>', session('errors')) ?>
                    </div>
                    <?php endif; ?>

                    <!-- Comment List -->
                    <?php if (!empty($comments)): ?>
                    <div class="space-y-4 mb-8">
                        <?php foreach ($comments as $comment): ?>
                        <div
                            class="bg-gray-800/60 backdrop-blur-sm rounded-2xl p-5 border border-gray-700/50 hover:border-gray-700 transition-colors">
                            <div class="flex items-start gap-3.5">
                                <div
                                    class="w-9 h-9 rounded-full bg-gradient-to-br from-lime-500 to-emerald-600 flex items-center justify-center text-gray-900 font-bold text-sm shrink-0 mt-0.5">
                                    <?= strtoupper(substr(esc($comment->author_name), 0, 1)) ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span
                                            class="text-white font-semibold text-sm"><?= esc($comment->author_name) ?></span>
                                        <span class="text-gray-600 text-xs">&middot;</span>
                                        <span
                                            class="text-gray-600 text-xs"><?= date('M j, Y', strtotime($comment->created_at)) ?></span>
                                    </div>
                                    <p class="text-gray-300 text-sm leading-relaxed">
                                        <?= nl2br(esc($comment->content)) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="bg-gray-800/40 rounded-2xl p-10 text-center border border-gray-800 mb-8">
                        <div class="w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold mb-1">No comments yet</h4>
                        <p class="text-gray-500 text-sm">Be the first to share your thoughts.</p>
                    </div>
                    <?php endif; ?>

                    <!-- Comment Form / Login Prompt -->
                    <?php if (auth()->loggedIn()): ?>
                    <div class="bg-gray-800/40 backdrop-blur-sm rounded-2xl p-6 border border-gray-700/50">
                        <h4 class="text-white font-semibold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Leave a Comment
                        </h4>
                        <form action="/comment" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="article_id" value="<?= $article->id ?>">
                            <div class="mb-4">
                                <textarea id="content" name="content" rows="4" required
                                    placeholder="Write your comment..."
                                    class="w-full bg-gray-900/50 border border-gray-700 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500/50 focus:border-lime-500/50 placeholder-gray-600 transition-all resize-none"><?= old('content') ?></textarea>
                            </div>
                            <button type="submit"
                                class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-xl hover:bg-lime-400 transition-all text-sm shadow-lg shadow-lime-500/10 hover:shadow-lime-500/20 active:scale-[0.98]">
                                <svg class="w-4 h-4 inline-block mr-1.5 -mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Post Comment
                            </button>
                        </form>
                    </div>
                    <?php else: ?>
                    <div class="bg-gray-800/40 backdrop-blur-sm rounded-2xl p-8 text-center border border-gray-700/50">
                        <div
                            class="w-14 h-14 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-4 border border-gray-700">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold mb-2">Join the Discussion</h4>
                        <p class="text-gray-500 text-sm mb-5">Sign in to leave a comment on this article.</p>
                        <div class="flex items-center justify-center gap-3">
                            <a href="/user-login"
                                class="bg-lime-500 text-gray-900 font-semibold px-5 py-2 rounded-xl text-sm hover:bg-lime-400 transition-all shadow-lg shadow-lime-500/10">Sign
                                In</a>
                            <a href="/user-register"
                                class="bg-gray-700 text-gray-300 font-medium px-5 py-2 rounded-xl text-sm hover:bg-gray-600 transition-all">Create
                                Account</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </main>

            <!-- ==================== SIDEBAR ==================== -->
            <aside class="w-full lg:w-80 shrink-0">
                <div class="lg:sticky lg:top-28 space-y-6">

                    <!-- Categories -->
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-5 border border-gray-700/50">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span class="w-1 h-4 bg-lime-500 rounded-full"></span>
                            Categories
                        </h3>
                        <ul class="space-y-1">
                            <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="/articles?category=<?= esc($cat->slug) ?>"
                                    class="text-gray-400 hover:text-lime-500 hover:bg-lime-500/5 px-3 py-2 rounded-lg text-sm transition-all flex items-center gap-2">
                                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <?= esc($cat->name) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Recent Articles -->
                    <?php if (!empty($recentPosts)): ?>
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-5 border border-gray-700/50">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span class="w-1 h-4 bg-lime-500 rounded-full"></span>
                            Recent Articles
                        </h3>
                        <ul class="space-y-3.5">
                            <?php foreach ($recentPosts as $recent): ?>
                            <li>
                                <a href="/article/<?= esc($recent->slug) ?>" class="group block">
                                    <h4
                                        class="text-sm font-medium text-gray-300 group-hover:text-lime-500 transition-colors leading-snug mb-1">
                                        <?= esc($recent->title) ?></h4>
                                    <span class="text-xs text-gray-600 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <?= date('M j, Y', strtotime($recent->published_at ?? $recent->created_at)) ?>
                                    </span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Tags -->
                    <?php if (!empty($tags)): ?>
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-5 border border-gray-700/50">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span class="w-1 h-4 bg-lime-500 rounded-full"></span>
                            Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag): ?>
                            <a href="/articles?tag=<?= esc($tag->slug) ?>"
                                class="bg-gray-700/50 text-gray-400 border border-gray-600/50 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-lime-500/10 hover:text-lime-400 hover:border-lime-500/30 transition-all"><?= esc($tag->name) ?></a>
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