<?= $header ?>

<body class="bg-gray-900 text-gray-100 font-sans">
  <!-- Navigation -->
  <nav class="bg-gray-800/90 backdrop-blur-md py-4 sticky top-0 z-50 shadow-lg">
    <div class="content-container px-6 flex justify-between items-center">
      <a href="/" class="text-2xl font-bold text-white flex items-center">
        <span class="bg-gradient-to-r from-lime-400 to-cyan-400 bg-clip-text text-transparent">Shaik
          Obydullah</span>
      </a>

      <!-- Desktop Menu (hidden on mobile) -->
      <div class="hidden md:flex space-x-8">
        <a href="/" class="text-gray-300 hover:text-white transition duration-300">Home</a>
        <a href="<?= base_url() ?>#skills" class="text-gray-300 hover:text-white transition duration-300">My
          Skills</a>
        <a href="<?= base_url() ?>#projects" class="text-gray-300 hover:text-white transition duration-300">My
          Projects</a>
        <a href="<?= base_url() ?>#articles" class="text-gray-300 hover:text-white transition duration-300">My
          Articles</a>
        <a href="<?= base_url() ?>#about" class="text-gray-300 hover:text-white transition duration-300">About</a>
        <a href="<?= base_url() ?>#contactMessageLink"
          class="text-gray-300 hover:text-white transition duration-300">Contact Me</a>
      </div>

      <!-- Mobile Menu Button (hidden on desktop) -->
      <div class="md:hidden">
        <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800/90 backdrop-blur-md px-6 pb-4 pt-2">
      <div class="flex flex-col space-y-3">
        <a href="/" class="text-gray-300 hover:text-white transition duration-300 py-2">Home</a>
        <a href="<?= base_url() ?>#skills" class="text-gray-300 hover:text-white transition duration-300 py-2">My
          Skills</a>
        <a href="<?= base_url() ?>#projects" class="text-gray-300 hover:text-white transition duration-300 py-2">My
          Projects</a>
        <a href="<?= base_url() ?>#articles" class="text-gray-300 hover:text-white transition duration-300 py-2">My
          Articles</a>
        <a href="<?= base_url() ?>#about" class="text-gray-300 hover:text-white transition duration-300 py-2">About</a>
        <a href="<?= base_url() ?>#contactMessageLink"
          class="text-gray-300 hover:text-white transition duration-300 py-2">Contact Me</a>
      </div>
    </div>
  </nav>

  <script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('#mobile-menu a').forEach(link => {
      link.addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.add('hidden');
      });
    });
  </script>

  <!-- Project Header -->
  <header class="relative bg-gradient-to-br from-gray-900 to-gray-800 py-20 overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 opacity-20">
      <div
        class="absolute top-1/4 left-1/4 w-32 h-32 bg-lime-500 rounded-full mix-blend-overlay filter blur-3xl animate-pulse">
      </div>
      <div
        class="absolute bottom-1/3 right-1/3 w-40 h-40 bg-cyan-500 rounded-full mix-blend-overlay filter blur-3xl opacity-70 animate-pulse delay-300">
      </div>
    </div>

    <!-- Content container -->
    <div class="content-container px-6 relative z-10">
      <div class="max-w-5xl mx-auto">
        <!-- Project title with gradient text -->
        <h1
          class="mt-[-3rem] text-4xl md:text-5xl lg:text-6xl font-bold text-center bg-clip-text text-transparent bg-gradient-to-r from-lime-400 to-cyan-400 leading-tight">
          <?= htmlspecialchars($project['title'] ?? 'Project Title', ENT_QUOTES, 'UTF-8') ?>
        </h1>

        <!-- Summary with fade-in animation -->
        <?php if (!empty($project['summary'])): ?>
          <div
            class="max-w-5xl mx-auto text-gray-300 text-lg md:text-xl text-center mb-12 mt-10 opacity-0 animate-fadeIn [animation-fill-mode:forwards]">
            <?= $project['summary'] ?>
          </div>
        <?php endif; ?>

        <!-- Meta information -->
        <div class="flex flex-wrap justify-center gap-4 mt-6 text-gray-400">
          <?php if (!empty($relatedTags)): ?>
            <div x-data='{ relatedTags: <?= json_encode($relatedTags) ?> }' class="flex flex-wrap gap-2 mb-4">
              <template x-for="tag in relatedTags" :key="tag.id">
                <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm" x-text="tag.name"></span>
              </template>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <!-- Project Content Section -->
  <section id="project-content" class="py-16 bg-gray-900">
    <div class="content-container px-6">
      <!-- Modern content container with sidebar space -->
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main content area (wider) -->
        <article class="lg:w-3/4">
          <!-- Content container with elegant border -->
          <div class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden">
            <!-- Project content with premium typography -->
            <div class="px-8 py-12" style="
    font-family: 'Inter', sans-serif;
    color: #e5e5e5;
    line-height: 1.7;
    max-width: none;
">
              <?php if (!empty($project['description'])): ?>
                <div style="
        --heading-gradient: linear-gradient(to right, #bef264, #22d3ee);
        --link-color: #22d3ee;
        --link-hover: #bef264;
        --bullet-gradient: linear-gradient(to right, #22d3ee, #bef264);
    ">
                  <!-- Headings -->
                  <style>
                    .prose-content h1,
                    .prose-content h2,
                    .prose-content h3,
                    .prose-content h4,
                    .prose-content h5,
                    .prose-content h6 {
                      font-weight: 700;
                      background-image: var(--heading-gradient);
                      -webkit-background-clip: text;
                      background-clip: text;
                      color: transparent;
                      margin-top: 1.5em;
                      margin-bottom: 0.8em;
                    }

                    .prose-content a {
                      color: var(--link-color);
                      font-weight: 500;
                      text-decoration: underline;
                      text-decoration-thickness: 2px;
                      text-underline-offset: 4px;
                      text-decoration-color: rgba(34, 211, 238, 0.3);
                      transition: all 0.3s ease;
                    }

                    .prose-content a:hover {
                      color: var(--link-hover);
                      text-decoration-color: rgba(34, 211, 238, 0.6);
                    }

                    .prose-content ul {
                      list-style-type: none;
                      padding-left: 1.5rem;
                      margin-top: 1.25rem;
                      margin-bottom: 1.25rem;
                    }

                    .prose-content ul li {
                      position: relative;
                      padding-left: 1.5rem;
                      margin-bottom: 0.75rem;
                    }

                    .prose-content ul li::before {
                      content: '';
                      position: absolute;
                      left: 0;
                      top: 0.5em;
                      width: 0.5rem;
                      height: 0.5rem;
                      background: var(--bullet-gradient);
                      border-radius: 50%;
                    }

                    .prose-content img {
                      border-radius: 1rem;
                      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                        0 10px 10px -5px rgba(0, 0, 0, 0.04);
                      border: 1px solid rgba(55, 65, 81, 0.5);
                      transition: all 0.3s ease;
                    }

                    .prose-content img:hover {
                      border-color: rgba(34, 211, 238, 0.3);
                    }

                    /* Table Styles for Dark Theme */
                    .prose-content table {
                      width: 100%;
                      border-collapse: collapse;
                      margin: 2rem 0;
                      font-size: 0.9rem;
                      background-color: #1e293b;
                      color: #e5e5e5;
                      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
                      border-radius: 0.5rem;
                      overflow: hidden;
                    }

                    .prose-content th,
                    .prose-content td {
                      padding: 0.75rem 1rem;
                      text-align: left;
                      border: 1px solid #334155;
                    }

                    .prose-content th {
                      background-color: #0f172a;
                      font-weight: 600;
                      color: #bef264;
                      /* Lime accent color */
                      text-transform: uppercase;
                      letter-spacing: 0.05em;
                      font-size: 0.8rem;
                    }

                    .prose-content tr:nth-child(even) {
                      background-color: #1f2937;
                    }

                    .prose-content tr:hover {
                      background-color: #334155;
                    }

                    /* Responsive Tables */
                    @media (max-width: 768px) {
                      .prose-content table {
                        display: block;
                        overflow-x: auto;
                        white-space: nowrap;
                        -webkit-overflow-scrolling: touch;
                      }

                      .prose-content th,
                      .prose-content td {
                        min-width: 120px;
                      }
                    }

                    /* Table Captions */
                    .prose-content caption {
                      caption-side: bottom;
                      margin-top: 1rem;
                      font-size: 0.8rem;
                      color: #94a3b8;
                      text-align: center;
                    }
                  </style>

                  <div class="prose-content">
                    <?= $project['description'] ?>
                  </div>
                </div>
              <?php else: ?>
                <div style="
        text-align: center;
        padding: 4rem 0;
    ">
                  <div style="
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 6rem;
          height: 6rem;
          background: linear-gradient(to bottom right, #1f2937, #111827);
          border-radius: 1rem;
          border: 1px solid rgba(55, 65, 81, 0.5);
          margin-bottom: 1.5rem;
      ">
                    <i class="fas fa-newspaper" style="
            font-size: 2.25rem;
            color: rgba(34, 211, 238, 0.8);
        "></i>
                  </div>
                  <p style="
          font-size: 1.5rem;
          font-weight: 500;
          color: #d1d5db;
          margin-bottom: 0.5rem;
      ">Project content coming soon</p>
                  <p style="
          color: #6b7280;
          font-size: 1rem;
      ">We're working on something amazing!</p>
                </div>
              <?php endif; ?>
            </div>

            <!-- Content footer with tags and social sharing -->
            <div class="border-t border-gray-700 px-8 py-6 bg-gray-800/50">
              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="flex items-center space-x-4">
                  <img class="w-10 h-10 rounded-full border-2 border-gray-800"
                    src="https://obydullah.com/uploads/media-library/1746805140_cb36bdfafbcfa1cfb070.jpg" alt="Author">
                  <div>
                    <p class="text-sm font-medium text-gray-100">
                      <?= htmlspecialchars($project['author'] ?? 'Shaik Obydullah', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p class="text-sm text-gray-400">Published on
                      <?= date('F j, Y', strtotime($project['created_at'] ?? 'now')) ?>
                    </p>
                  </div>
                </div>

                <!-- Social sharing buttons -->
                <div class="flex space-x-4">
                  <a href="<?= htmlspecialchars($settings['linkedin'], ENT_QUOTES, 'UTF-8') ?>" target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-700 hover:bg-blue-600 transition duration-300 flex items-center justify-center text-white">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a target="_blank" href="<?= htmlspecialchars($settings['github'], ENT_QUOTES, 'UTF-8') ?>"
                    target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-700 hover:bg-black transition duration-300 flex items-center justify-center text-white">
                    <i class="fab fa-github"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </article>

        <!-- Sidebar -->
        <aside class="lg:w-1/4 space-y-6">

          <div
            class="bg-gray-800/50 border border-gray-700 rounded-xl hover:border-lime-400 transition-all duration-300">
            <div class="p-5">
              <h3 class="text-xl font-bold text-white mb-5 pb-3 border-b border-gray-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-lime-400 mr-2" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                More Projects
              </h3>

              <div class="space-y-5">
                <?php foreach ($relatedProjects as $project): ?>
                  <a href="/project/<?= esc($project['slug']) ?>"
                    class="block group p-3 -m-3 rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                    <div class="flex items-start">
                      <div class="flex-1 min-w-0">
                        <h4 class="text-base font-semibold text-white group-hover:text-lime-400 transition-colors mb-1.5">
                          <?= esc($project['title']) ?>
                        </h4>
                        <div
                          class="w-full h-[2px] bg-lime-500 mb-3 opacity-80 group-hover:opacity-100 transition-opacity">
                        </div>
                        <p class="text-gray-300 text-sm line-clamp-2 mb-2">
                          <?= esc($project['summary']) ?>
                        </p>
                        <div class="flex items-center text-xs text-gray-400">
                          <span><?= date($date_format, strtotime($project['created_at'])) ?></span>
                          <span class="mx-2">•</span>
                          <span class="text-lime-400 font-medium inline-flex items-center">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <!-- Back to Top Button -->
  <button id="back-to-top"
    class="fixed bottom-8 right-8 bg-white text-gray-900 p-3 rounded-full shadow-lg hover:bg-gray-200 transition hidden">↑</button>

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