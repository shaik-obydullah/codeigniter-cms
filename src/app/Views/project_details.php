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
                <div class="flex flex-wrap gap-2 mb-4">
                    <?php if (!empty($projectCats)): ?>
                    <?php foreach ($projectCats as $cat): ?>
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($cat->name) ?></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (!empty($projectTags)): ?>
                    <?php foreach ($projectTags as $tag): ?>
                    <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($tag->name) ?></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($project->title) ?></h1>
                <div class="flex items-center text-gray-400 text-sm mb-8 flex-wrap gap-x-4">
                    <span><i
                            class="far fa-calendar-alt mr-2"></i><?= date('M j, Y', strtotime($project->created_at)) ?></span>
                </div>
                <?php if ($project->featured_image): ?>
                <img src="<?= esc($project->featured_image) ?>" alt="<?= esc($project->title) ?>"
                    class="w-full h-72 md:h-96 object-cover rounded-xl mb-8" />
                <?php endif; ?>
                <div class="prose prose-invert max-w-none">
                    <?= $project->description ?>
                </div>
                <div class="flex items-center gap-4 mt-10 pt-8 border-t border-gray-700">
                    <span class="text-gray-400 font-medium">Share:</span>
                    <a href="https://linkedin.com/share?url=<?= urlencode(current_url()) ?>" target="_blank"
                        class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in text-xl"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>" target="_blank"
                        class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank"
                        class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f text-xl"></i></a>
                </div>

                <div class="mt-12 pt-8 border-t border-gray-700">
                    <h3 class="text-2xl font-bold text-white mb-6">Comments</h3>

                    <?php if (session('message')): ?>
                    <div
                        class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm">
                        <?= esc(session('message')) ?></div>
                    <?php endif; ?>
                    <?php if (session('errors')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm">
                        <?= implode('<br>', session('errors')) ?></div>
                    <?php endif; ?>

                    <?php if (!empty($comments)): ?>
                    <div class="space-y-4 mb-8">
                        <?php foreach ($comments as $comment): ?>
                        <div class="bg-gray-800 rounded-lg p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-lime-500 flex items-center justify-center text-gray-900 font-bold text-sm">
                                    <?= strtoupper(substr(esc($comment->author_name), 0, 1)) ?></div>
                                <div>
                                    <span
                                        class="text-white font-medium text-sm"><?= esc($comment->author_name) ?></span>
                                    <span
                                        class="text-gray-500 text-xs ml-2"><?= date('M j, Y', strtotime($comment->created_at)) ?></span>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm"><?= nl2br(esc($comment->content)) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-500 mb-8">No comments yet. Be the first to comment!</p>
                    <?php endif; ?>

                    <?php if (auth()->loggedIn()): ?>
                    <div class="bg-gray-800 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-white mb-4">Leave a Comment</h4>
                        <form action="/comment" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="project_id" value="<?= $project->id ?>">

                            <div class="mb-4">
                                <label for="content"
                                    class="block text-sm font-medium text-gray-300 mb-1">Comment</label>
                                <textarea id="content" name="content" rows="4" required
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500"><?= old('content') ?></textarea>
                            </div>

                            <button type="submit"
                                class="bg-lime-500 text-gray-900 font-semibold px-6 py-2.5 rounded-lg hover:bg-lime-400 transition shadow-lg shadow-lime-500/25 text-sm">
                                <i class="fas fa-paper-plane mr-2"></i> Submit Comment
                            </button>
                        </form>
                    </div>
                    <?php else: ?>
                    <div class="bg-gray-800 rounded-xl p-6 text-center">
                        <i class="fas fa-comment-dots text-4xl text-gray-600 mb-3"></i>
                        <h4 class="text-lg font-semibold text-white mb-2">Join the Discussion</h4>
                        <p class="text-gray-400 text-sm mb-4">Please <a href="/user-login"
                                class="text-lime-500 hover:text-lime-400 font-medium">sign in</a> or <a
                                href="/user-register" class="text-lime-500 hover:text-lime-400 font-medium">create an
                                account</a> to leave a comment.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <?php foreach ($categories as $cat): ?>
                            <li><a href="/projects?category=<?= esc($cat->slug) ?>"
                                    class="text-gray-400 hover:text-lime-500 transition flex justify-between"><span><?= esc($cat->name) ?></span></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (!empty($recentProjects)): ?>
                    <div class="bg-gray-800 rounded-xl p-5">
                        <h3 class="text-lg font-semibold text-white mb-4">Recent Projects</h3>
                        <ul class="space-y-4">
                            <?php foreach ($recentProjects as $recent): ?>
                            <li>
                                <a href="/project/<?= esc($recent->slug) ?>" class="group flex gap-3">
                                    <div>
                                        <h4
                                            class="text-sm font-medium text-white group-hover:text-lime-500 transition leading-tight">
                                            <?= esc($recent->title) ?></h4>
                                        <span
                                            class="text-xs text-gray-500"><?= date('M j, Y', strtotime($recent->created_at)) ?></span>
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
                            <a href="/projects?tag=<?= esc($tag->slug) ?>"
                                class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm hover:bg-lime-500 hover:text-gray-900 transition"><?= esc($tag->name) ?></a>
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