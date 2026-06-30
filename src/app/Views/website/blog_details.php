<?= $header ?>

<body class="bg-gray-900 text-gray-100 font-sans">
    <nav class="bg-gray-800/90 backdrop-blur-md py-4 sticky top-0 z-50 shadow-[1px_1px_2px_white]">
        <div class="content-container px-6 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold flex items-center">
                <span class="bg-gradient-to-r from-lime-400 to-cyan-400 bg-clip-text text-transparent"><?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-300 hover:text-white transition duration-300">Home</a>
                <a href="<?= base_url() ?>#skills" class="text-gray-300 hover:text-white transition duration-300">Skills</a>
                <a href="<?= base_url() ?>#projects" class="text-gray-300 hover:text-white transition duration-300">Projects</a>
                <a href="<?= base_url() ?>#contact" class="text-gray-300 hover:text-white transition duration-300">Contact</a>
            </div>
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800/90 backdrop-blur-md px-6 pb-4 pt-2">
            <div class="flex flex-col space-y-3">
                <a href="/" class="text-gray-300 hover:text-white transition duration-300 py-2">Home</a>
                <a href="#skills" class="text-gray-300 hover:text-white transition duration-300 py-2">Skills</a>
                <a href="#projects" class="text-gray-300 hover:text-white transition duration-300 py-2">Projects</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition duration-300 py-2">Contact</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });
    </script>

    <section class="py-20">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700">
                <?php if ($blog_info['featured_image']) : ?>
                    <img src="<?= base_url() . '/uploads/blog/featured_image/' . $blog_info['featured_image'] ?>" alt="<?= $blog_info['blog_title'] ?>" class="w-full h-64 md:h-96 object-cover">
                <?php endif; ?>
                <div class="p-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4"><?= $blog_info['blog_title'] ?></h1>
                    <p class="text-lg text-gray-400 mb-6"><?= $blog_info['blog_summary'] ?></p>
                    <?php
                    $date = $blog_info['modify_date'] ? $blog_info['modify_date'] : $blog_info['create_date'];
                    ?>
                    <p class="text-gray-500 text-sm mb-4">Published: <?php echo date($settings['date_format'] ?? 'F j, Y', strtotime($date)) ?></p>

                    <?php if ($blog_info['tags']) : ?>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <?php foreach ($blog_info['tags'] as $tag) : ?>
                                <span class="bg-lime-600/20 text-lime-400 text-xs px-3 py-1 rounded-full"><?= implode(', ', $tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <hr class="border-gray-700 mb-6">
                    <?php endif; ?>

                    <div class="text-gray-300 leading-relaxed text-lg space-y-4">
                        <?= $blog_info['blog'] ?>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="<?= base_url() ?>/blog" class="inline-flex items-center bg-white text-gray-900 px-6 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Blog
                </a>
            </div>
        </div>
    </section>

    <?= $footer ?>
</body>
</html>
