<?= $header ?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  /* Base Styles */
  body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
    color: #111827;
    line-height: 1.6;
  }

  /* Gradient Text */
  .gradient-text {
    background: linear-gradient(90deg, #3B82F6 0%, #8B5CF6 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }

  /* Article Tag Styles */
  .article-tag {
    transition: all 0.2s ease;
  }

  .article-tag:hover {
    transform: translateY(-1px);
  }

  /* Related Article Hover Effect */
  .related-article:hover img {
    transform: scale(1.05);
  }

  /* Mobile Menu Animation */
  .mobile-menu {
    transition: all 0.3s ease-in-out;
    transform: translateY(-150%);
    opacity: 0;
  }

  .mobile-menu.active {
    transform: translateY(0);
    opacity: 1;
  }

  /* Fade-in Animation */
  @keyframes fade-in {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in {
    animation: fade-in 1s ease-out;
  }

  /* Article Content Styles */
  .article-content {
    max-width: none;
    margin-top: 1rem;
    margin-bottom: 2.5rem;
    font-family: 'Inter', sans-serif;
    color: #1e293b;
    line-height: 1.75;
    font-size: 1.125rem;
  }

  .article-content h1,
  .article-content h2,
  .article-content h3 {
    font-weight: 700;
    color: #111827;
    margin-top: 1.5em;
    margin-bottom: 0.8em;
    line-height: 1.3;
  }

  .article-content h1 {
    font-size: 1.875rem;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 0.5rem;
  }

  .article-content h2 {
    font-size: 1.5rem;
  }

  .article-content h3 {
    font-size: 1.25rem;
  }

  .article-content p {
    margin-bottom: 1.5em;
  }

  .article-content a {
    color: #3b82f6;
    text-decoration: underline;
    text-underline-offset: 4px;
    transition: color 0.2s ease;
    font-weight: 500;
  }

  .article-content a:hover {
    color: #2563eb;
  }

  .article-content ul,
  .article-content ol {
    padding-left: 1.5rem;
    margin: 1.25rem 0;
  }

  .article-content ul {
    list-style-type: disc;
  }

  .article-content ol {
    list-style-type: decimal;
  }

  .article-content li {
    margin-bottom: 0.75rem;
    padding-left: 0.5rem;
  }

  .article-content img {
    border-radius: 0.75rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin: 2rem auto;
    max-width: 100%;
    height: auto;
    display: block;
  }

  .article-content blockquote {
    border-left: 4px solid #3b82f6;
    background-color: #f8fafc;
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    border-radius: 0.375rem;
    font-style: italic;
    color: #334155;
  }

  .article-content pre {
    background-color: #1e293b;
    padding: 1.25rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
    color: #f8fafc;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    line-height: 1.5;
  }

  /* Table Styles - Force light appearance even in dark mode */
  .article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    font-size: 0.875rem;
    background-color: white !important;
    color: #1e293b !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .article-content th,
  .article-content td {
    padding: 0.75rem;
    text-align: left;
    border: 1px solid #e2e8f0 !important;
    background-color: white !important;
    color: #1e293b !important;
  }

  .article-content th {
    background-color: #f1f5f9 !important;
    font-weight: 600;
    color: #1e293b !important;
  }

  .article-content tr:nth-child(even) {
    background-color: #f8fafc !important;
  }

  /* Mobile-specific styles */
  @media (max-width: 768px) {
    .article-content {
      font-size: 1rem;
    }

    .article-content h1 {
      font-size: 1.5rem;
    }

    .article-content h2 {
      font-size: 1.25rem;
    }

    .article-content h3 {
      font-size: 1.125rem;
    }

    .article-content table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
  }

  /* Dark mode styles */
  @media (prefers-color-scheme: dark) {
    body {
      background-color: #0f172a;
      color: #111827;
    }

    .article-content {
      color: #111827;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3 {
      color: #111827;
    }

    .article-content a {
      color: #111827;
    }

    .article-content a:hover {
      color: #93c5fd;
    }

    .article-content blockquote {
      background-color: white;
      color: #111827;
    }

    .article-content img {
      color: #111827;
    }

    /* Keep tables light in dark mode */
    .article-content th {
      background-color: white !important;
      color: white !important;
    }

    .article-content td {
      background-color: white !important;
      color: black !important;
    }

    .article-content th {
      background-color: #111827 !important;
    }

    .article-content tr:nth-child(even) {
      background-color: #111827 !important;
    }
  }

  /* Back to top button */
  #back-to-top {
    transition: all 0.3s ease;
  }

  #back-to-top:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  }
</style>

<body class="bg-gray-50">
  <!-- Navigation -->
  <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200"
    x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <a href="<?= base_url() ?>" class="flex items-center text-primary-600 font-bold text-xl">
            <i class="fas fa-code text-primary-500 mr-2"></i>
            Shaik Obydullah
          </a>
        </div>

        <div class="hidden md:block">
          <nav class="flex space-x-8">
            <a href="<?= base_url() ?>" class="text-primary-600 font-medium px-3 py-2 rounded-md">Home</a>
            <a href="<?= base_url() ?>#skills"
              class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Skills</a>
            <a href="<?= base_url() ?>#projects"
              class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Projects</a>
            <a href="<?= base_url() ?>#articles"
              class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Articles</a>
            <a href="<?= base_url() ?>#about"
              class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">About</a>
            <a href="<?= base_url() ?>#contactMessageLink"
              class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">Contact</a>
          </nav>
        </div>

        <div class="md:hidden">
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-gray-900 focus:outline-none"
            aria-label="Toggle menu">
            <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
            <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform -translate-y-2"
      x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 transform translate-y-0"
      x-transition:leave-end="opacity-0 transform -translate-y-2"
      class="fixed inset-x-0 top-16 z-40 bg-white shadow-lg border-b border-gray-200 md:hidden">
      <div class="container mx-auto px-4 py-2">
        <nav class="flex flex-col space-y-2">
          <a href="<?= base_url() ?>" @click="mobileMenuOpen = false"
            class="text-primary-600 font-medium px-3 py-2 rounded-md">Home</a>
          <a href="<?= base_url() ?>#skills" @click="mobileMenuOpen = false"
            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Skills</a>
          <a href="<?= base_url() ?>#projects" @click="mobileMenuOpen = false"
            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Projects</a>
          <a href="<?= base_url() ?>#articles" @click="mobileMenuOpen = false"
            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Articles</a>
          <a href="<?= base_url() ?>#about" @click="mobileMenuOpen = false"
            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">About</a>
          <a href="<?= base_url() ?>#contactMessageLink" @click="mobileMenuOpen = false"
            class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">Contact</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Article Header -->
  <section class="py-20 bg-gradient-to-br from-lime-100 via-white to-lime-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
      <div class="text-center">
        <!-- Title -->
        <h1
          class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight bg-clip-text text-transparent bg-gradient-to-r from-lime-500 via-emerald-500 to-teal-500 animate-fade-in">
          <?= htmlspecialchars($article['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </h1>

        <!-- Subtitle / Summary -->
        <p class="mt-6 text-lg md:text-xl text-gray-700 max-w-2xl mx-auto">
          <?= htmlspecialchars($article['summary'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <div class="container mt-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Article Content -->
      <main class="lg:w-2/3">
        <!-- Tag -->
        <?php if (!empty($relatedTags)): ?>
          <div x-data='{ relatedTags: <?= json_encode($relatedTags) ?> }' class="flex flex-wrap gap-2 mb-4">
            <template x-for="tag in relatedTags" :key="tag.id">
              <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm" x-text="tag.name"></span>
            </template>
          </div>
        <?php endif; ?>

        <article class="article-content">
          <div class="article-content">
            <?= $article['description'] ?? '' ?>
          </div>
        </article>
      </main>

      <!-- Sidebar -->
      <aside class="lg:w-1/3 space-y-6">
        <!-- Author Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
          <h3 class="flex items-center text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-user-circle text-primary-500 mr-2"></i>
            About the Author
          </h3>

          <div class="flex items-center space-x-4 mb-4">
            <img src="https://obydullah.com/uploads/media-library/1746805140_cb36bdfafbcfa1cfb070.jpg" alt="Author"
              class="w-16 h-16 rounded-full border-2 border-primary-200">
            <div>
              <h4 class="font-medium text-gray-900">Shaik Obydullah</h4>
              <p class="text-sm text-gray-500">Full-stack Developer</p>
            </div>
          </div>

          <p class="text-gray-600 text-sm">
            I am a Full Stack Software Engineer and Cloud Computing specialist with expertise in designing and
            implementing scalable, business-driven solutions. With a strong foundation in PHP, JavaScript frameworks,
            and database management, I specialize in building end-to-end web applications while analyzing business
            requirements to deliver efficient systems. My experience in cloud platforms allows me to design and deploy
            modern, cost-effective infrastructure. I am passionate about leveraging technology to solve complex problems
            and drive business growth.
          </p>

          <div class="flex space-x-3 mt-4">
            <a href="<?= htmlspecialchars($settings['linkedin'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
              class="text-gray-500 hover:text-primary-500">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="<?= htmlspecialchars($settings['github'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
              class="text-gray-500 hover:text-primary-500">
              <i class="fab fa-github"></i>
            </a>
          </div>
        </div>

        <!-- Related Articles -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
          <h3 class="flex items-center text-lg font-semibold text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
            Related Articles
          </h3>

          <div class="space-y-4" x-data='{ relatedArticles: <?= json_encode($relatedArticles ?? []) ?> }'>
            <template x-for="article in relatedArticles" :key="article.id">
              <a :href="'/article/' + article.slug" class="block group p-4 -m-4 rounded-lg hover:bg-gray-50 transition-all duration-200">
                <div class="flex items-start">
                  <div class="flex-1 min-w-0">
                    <div class="w-full h-[2px] bg-primary-500 mb-3 opacity-80 group-hover:opacity-100 transition-opacity"></div>
                    <h4 class="text-base font-semibold text-gray-900 group-hover:text-primary-600 transition-colors mb-1.5" x-text="article.title"></h4>
                    <p class="text-gray-600 text-sm line-clamp-2" x-text="article.summary"></p>
                    <div class="flex items-center text-xs text-gray-500 mt-2">
                      <span x-text="new Date(article.created_at).toLocaleDateString()"></span>
                      <span class="mx-2">•</span>
                      <span class="text-primary-600 font-medium inline-flex items-center">
                        Read Article
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                      </span>
                    </div>
                  </div>
                </div>
              </a>
            </template>
          </div>
        </div>
      </aside>
    </div>
  </div>

  <!-- Back to Top Button -->
  <button id="back-to-top"
    class="fixed bottom-8 right-8 bg-white text-gray-900 p-3 rounded-full shadow-lg hover:bg-gray-200 transition hidden border border-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
        clip-rule="evenodd" />
    </svg>
  </button>

  <script>
    // Back to Top Button
    const backToTopButton = document.getElementById("back-to-top");

    window.addEventListener("scroll", () => {
      if (window.scrollY > 300) {
        backToTopButton.classList.remove("hidden");
      } else {
        backToTopButton.classList.add("hidden");
      }
    });

    backToTopButton.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  </script>
  <?= $footer ?>
</body>

</html>