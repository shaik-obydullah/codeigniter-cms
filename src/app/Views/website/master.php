<?= $header ?>

<body class="bg-gray-900 text-gray-100 font-sans">

    <!-- Navigation -->
    <nav class="bg-gray-800/90 backdrop-blur-md py-4 sticky top-0 z-50 shadow-[1px_1px_2px_white]">
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
                <a href="<?= base_url() ?>#about"
                    class="text-gray-300 hover:text-white transition duration-300">About</a>
                <a href="<?= base_url() ?>#contactMessageLink"
                    class="text-gray-300 hover:text-white transition duration-300">Contact Me</a>
            </div>

            <!-- Mobile Menu Button (hidden on desktop) -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800/90 backdrop-blur-md px-6 pb-4 pt-2">
            <div class="flex flex-col space-y-3">
                <a href="/" class="text-gray-300 hover:text-white transition duration-300 py-2">Home</a>
                <a href="<?= base_url() ?>#skills"
                    class="text-gray-300 hover:text-white transition duration-300 py-2">My
                    Skills</a>
                <a href="<?= base_url() ?>#projects"
                    class="text-gray-300 hover:text-white transition duration-300 py-2">My
                    Projects</a>
                <a href="<?= base_url() ?>#articles"
                    class="text-gray-300 hover:text-white transition duration-300 py-2">My
                    Articles</a>
                <a href="<?= base_url() ?>#about"
                    class="text-gray-300 hover:text-white transition duration-300 py-2">About</a>
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


    <!-- Loading Animation -->
    <div id="loading" class="fixed inset-0 bg-gray-900 flex items-center justify-center z-50">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-white"></div>
    </div>

    <!-- Header Section -->
    <header class="header-bg relative py-32 text-center text-white overflow-hidden">
        <!-- Overlay -->
        <div class="header-overlay absolute inset-0"></div>
        <!-- Circle transition -->
        <div class="circle-transition"></div>
        <!-- Animated Circles -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-64 h-64 bg-white/10 rounded-full animate-pulse"></div>
            <div class="w-96 h-96 bg-white/5 rounded-full absolute animate-pulse delay-500"></div>
        </div>
        <!-- Content -->
        <div class="header-content container mx-auto px-6 relative z-20">
            <h1 class="text-5xl font-bold mb-4">Shaik Obydullah</h1>
            <p class="text-xl mb-8"><?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            <a href="#projects"
                class="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">View My
                Work</a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="relative py-20 overflow-hidden">
        <!-- Matrix Binary Effect Canvas -->
        <canvas id="matrix-canvas" class="absolute inset-0 z-0"></canvas>
        <!-- Content -->
        <div class="container mx-auto px-6 text-center max-w-6xl relative z-10">
            <h2 class="text-4xl font-bold text-white mb-6">About Me</h2>
            <p class="text-lg text-gray-300 leading-relaxed bg-gray-800/80 backdrop-blur-sm p-8 rounded-3xl shadow-lg">
                I am a Full Stack Software Engineer and Cloud Computing specialist with expertise in designing and
                implementing scalable, business-driven solutions. With a strong foundation in PHP, JavaScript
                frameworks, and database management, I specialize in building end-to-end web applications while
                analyzing business requirements to deliver efficient systems. My experience in cloud platforms allows me
                to design and deploy modern, cost-effective infrastructure. I am passionate about leveraging technology
                to solve complex problems and drive business growth.
            </p>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="bg-gray-800 py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-6 text-center">Skills</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Frontend Skills -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-react text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">React.js</h3>
                    <p class="text-gray-300 mt-2">Experienced in building modern, dynamic user interfaces using hooks,
                        state management, and functional components.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-js-square text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Next.js</h3>
                    <p class="text-gray-300 mt-2">Proficient in building SEO-friendly, fast-loading frontends with
                        Next.js, leveraging server-side rendering and static site generation for optimal performance and
                        user experience.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-css3-alt text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Tailwind CSS</h3>
                    <p class="text-gray-300 mt-2">Proficient in creating responsive, modern user interfaces, enabling
                        faster development and consistent design across projects.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-mountain text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Alpine.js</h3>
                    <p class="text-gray-300 mt-2">Experienced in creating interactive components like modals, dropdowns,
                        and forms using Alpine.js.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-bootstrap text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Bootstrap</h3>
                    <p class="text-gray-300 mt-2">Skilled in building responsive, mobile-first web interfaces that
                        deliver fast, flexible, and user-friendly experiences using Bootstrap CSS framework.</p>
                </div>

                <!-- Backend Skills -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-php text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">PHP</h3>
                    <p class="text-gray-300 mt-2">Highly skilled in modern PHP development, including Composer, PSR
                        standards, and OOP. Experienced in building custom PHP frameworks, RESTful APIs, and scalable
                        backend systems for complex web applications.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-laravel text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Laravel</h3>
                    <p class="text-gray-300 mt-2">Experienced in developing scalable applications with Laravel,
                        including building RESTful APIs and optimizing performance for clean, maintainable code.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-bolt text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Laravel Livewire</h3>
                    <p class="text-gray-300 mt-2">Experienced in Laravel Livewire for building dynamic, reactive UIs
                        with real-time updates, seamless form handling, and tight integration with Laravel Blade.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-python text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Python & Flask</h3>
                    <p class="text-gray-300 mt-2">Experienced in Python and Flask, developing efficient web applications
                        and performing data analysis using libraries like Pandas, NumPy, and Matplotlib.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-fire text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">CodeIgniter</h3>
                    <p class="text-gray-300 mt-2">Experienced in CodeIgniter for building scalable, secure, and
                        maintainable MVC-based web applications.</p>
                </div>

                <!-- Database Skills -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-database text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">MySQL</h3>
                    <p class="text-gray-300 mt-2">Experienced in MySQL database management, including query
                        optimization, indexing, and performance tuning for scalable and efficient applications.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-database text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">PostgreSQL</h3>
                    <p class="text-gray-300 mt-2">Expert in spatial data with PostGIS, advanced query optimization using
                        parallel queries and leveraging features like Foreign Data Wrappers for high-performance data
                        management.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-database text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Oracle Database</h3>
                    <p class="text-gray-300 mt-2">Experienced in Oracle database management, including database design,
                        performance tuning, and complex query optimization for scalable and efficient enterprise
                        applications.</p>
                </div>

                <!-- DevOps Skills -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-docker text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Docker</h3>
                    <p class="text-gray-300 mt-2">Experienced in containerizing applications with Docker, ensuring
                        consistency across environments and simplifying deployment.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-github text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">CI/CD Implementation</h3>
                    <p class="text-gray-300 mt-2">Proficient in implementing automated CI/CD pipelines for continuous
                        integration, testing, and deployment to streamline development workflows.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-aws text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">AWS</h3>
                    <p class="text-gray-300 mt-2">Proficient in AWS cloud services, including EC2, S3, Lambda, and RDS,
                        for building scalable, secure, and cost-effective cloud applications.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-digital-ocean text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">DigitalOcean</h3>
                    <p class="text-gray-300 mt-2">Skilled in deploying applications on DigitalOcean, utilizing Droplets,
                        Kubernetes, and managed databases for scalable hosting solutions.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-google text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">GCP</h3>
                    <p class="text-gray-300 mt-2">Proficient in Google Cloud Platform (GCP), including services like
                        Compute Engine, Cloud Storage, and Kubernetes Engine for building and managing cloud
                        infrastructure.</p>
                </div>

                <!-- Tools -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-git-alt text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Git & GitHub</h3>
                    <p class="text-gray-300 mt-2">Experienced in version control with Git and GitHub, including
                        branching, merging, and collaborating on code with teams.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fab fa-js text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">TypeScript</h3>
                    <p class="text-gray-300 mt-2">Strong knowledge of TypeScript, including advanced types, interfaces,
                        and generics for building scalable and maintainable applications.</p>
                </div>

                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fas fa-project-diagram text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Design Pattern</h3>
                    <p class="text-gray-300 mt-2">Strong understanding of software design patterns, specializing in
                        creating scalable and maintainable architecture.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 bg-gray-900" x-data="projectsComponent()">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-12 text-center">Projects</h2>

            <!-- Loading State -->
            <div x-show="isLoading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-lime-500">
                </div>
                <p class="text-gray-300 mt-4">Loading projects...</p>
            </div>

            <!-- Error State -->
            <div x-show="error" class="bg-red-900/50 border border-red-700 text-red-100 px-4 py-3 rounded relative"
                role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline" x-text="error"></span>
                <button @click="fetchProjects()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-100" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>

            <!-- Success State -->
            <div x-show="!isLoading && !error" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="project in projects" :key="project.id">
                    <div
                        class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-lime-500 transition-all hover:shadow-lg hover:shadow-lime-500/10 group">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-semibold text-white group-hover:text-lime-400 transition-colors"
                                    x-text="project.title"></h3>
                                <div class="w-full h-1 bg-lime-500 mt-2"></div>
                            </div>
                            <p class="text-gray-300" x-text="project.summary"></p>
                            <div class="pt-2">
                                <a :href="`<?= base_url() ?>project/${project.slug}`"
                                    class="text-lime-500 hover:text-lime-400 font-medium inline-flex items-center">
                                    View Details
                                    <span class="ml-2 transition-transform group-hover:translate-x-1">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="projects.length === 0 && !isLoading && !error" class="col-span-full text-center py-12">
                    <p class="text-gray-400">No projects found</p>
                </div>
            </div>

            <!-- Load More Button -->
            <div x-show="hasMore && projects.length > 0" class="text-center mt-8">
                <button @click="loadMore()" :disabled="isLoadingMore"
                    class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-3 px-6 rounded-full transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-text="isLoadingMore ? 'Loading...' : 'Load More Projects'"></span>
                </button>
                <div x-show="isLoadingMore"
                    class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-lime-500 ml-4">
                </div>
            </div>

            <!-- End of Results -->
            <div x-show="!hasMore && projects.length > 0" class="text-center text-gray-400 py-4">
                No more projects to load
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('projectsComponent', () => ({
                projects: [],
                isLoading: true,
                isLoadingMore: false,
                error: null,
                currentPage: 1,
                hasMore: true,

                init() {
                    this.fetchProjects();
                },

                async fetchProjects() {
                    this.isLoading = true;
                    this.error = null;

                    try {
                        const response = await fetch(`/projects?page=${this.currentPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();
                        this.projects = data.data || [];
                        this.hasMore = data.has_more || false;
                        this.currentPage++;
                    } catch (error) {
                        console.error('Error fetching projects:', error);
                        this.error = error.message || 'Failed to load projects';
                    } finally {
                        this.isLoading = false;
                    }
                },

                async loadMore() {
                    if (!this.hasMore || this.isLoadingMore) return;

                    this.isLoadingMore = true;

                    try {
                        const response = await fetch(`/projects?page=${this.currentPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();
                        this.projects = [...this.projects, ...(data.data || [])];
                        this.hasMore = data.has_more || false;
                        this.currentPage++;
                    } catch (error) {
                        console.error('Error loading more projects:', error);
                        this.error = error.message || 'Failed to load more projects';
                    } finally {
                        this.isLoadingMore = false;
                    }
                }
            }));
        });
    </script>

    <!-- Articles Section -->
    <section id="articles" class="bg-gray-800 py-20" x-data="articlesComponent()">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-12 text-center">Articles</h2>

            <!-- Loading State -->
            <div x-show="isLoading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-lime-500">
                </div>
                <p class="text-gray-300 mt-4">Loading articles...</p>
            </div>

            <!-- Error State -->
            <div x-show="error" class="bg-red-900/50 border border-red-700 text-red-100 px-4 py-3 rounded relative"
                role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline" x-text="error"></span>
                <button @click="fetchArticles()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-100" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>

            <!-- Success State -->
            <div x-show="!isLoading && !error" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="article in articles" :key="article.id">
                    <div
                        class="bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-white mb-2" x-text="article.title"></h3>
                            <p class="text-gray-300 mb-4" x-text="article.summary"></p>
                            <a :href="`/article/${article.slug}`"
                                class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More →</a>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="articles.length === 0 && !isLoading && !error" class="col-span-full text-center py-12">
                    <p class="text-gray-400">No articles found</p>
                </div>
            </div>

            <!-- Load More Button -->
            <div x-show="hasMore && articles.length > 0" class="text-center mt-8">
                <button @click="loadMore()" :disabled="isLoadingMore"
                    class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-3 px-6 rounded-full transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-text="isLoadingMore ? 'Loading...' : 'Load More Articles'"></span>
                </button>
                <div x-show="isLoadingMore"
                    class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-lime-500 ml-4">
                </div>
            </div>

            <!-- End of Results -->
            <div x-show="!hasMore && articles.length > 0" class="text-center text-gray-400 py-4">
                No more articles to load
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('articlesComponent', () => ({
                articles: [],
                isLoading: true,
                isLoadingMore: false,
                error: null,
                currentPage: 1,
                hasMore: true,

                init() {
                    this.fetchArticles();
                },

                async fetchArticles() {
                    this.isLoading = true;
                    this.error = null;

                    try {
                        const response = await fetch(`/articles?page=${this.currentPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();
                        this.articles = data.data || [];
                        this.hasMore = data.has_more || false;
                        this.currentPage++;
                    } catch (error) {
                        console.error('Error fetching articles:', error);
                        this.error = error.message || 'Failed to load articles';
                    } finally {
                        this.isLoading = false;
                    }
                },

                async loadMore() {
                    if (!this.hasMore || this.isLoadingMore) return;

                    this.isLoadingMore = true;

                    try {
                        const response = await fetch(`/articles?page=${this.currentPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();
                        this.articles = [...this.articles, ...(data.data || [])];
                        this.hasMore = data.has_more || false;
                        this.currentPage++;
                    } catch (error) {
                        console.error('Error loading more articles:', error);
                        this.error = error.message || 'Failed to load more articles';
                    } finally {
                        this.isLoadingMore = false;
                    }
                }
            }));
        });
    </script>

    <!-- Contact Section -->
    <section id="contact" class="relative bg-gray-900 py-24 overflow-hidden" x-data="contactComponent()">
        <!-- Animated Background Texture -->
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-stripes.png')] opacity-20 animate-moveBackground">
        </div>

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-5xl font-bold text-white mb-6">Let's Work Together!</h2>
            <p class="text-lg text-gray-300 mb-12 max-w-2xl mx-auto">I'm always excited to collaborate on new projects,
                explore job opportunities, or just chat about ideas. Reach out, and let's create something extraordinary
                together!</p>
            <div id="contactMessageLink" class="flex flex-col sm:flex-row justify-center items-center gap-6">
                <button @click="isModalOpen = true"
                    class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition transform hover:scale-105 shadow-lg">
                    Email Me
                </button>

                <a href="#projects"
                    class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition transform hover:scale-105">
                    View My Work
                </a>
            </div>
            <div class="mt-12 flex justify-center space-x-6">
                <a target="_blank" href="<?= htmlspecialchars($settings['linkedin'], ENT_QUOTES, 'UTF-8') ?>"
                    class="text-gray-300 hover:text-white transition">
                    <i class="fab fa-linkedin-in text-2xl"></i>
                </a>
                <a target="_blank" href="<?= htmlspecialchars($settings['github'], ENT_QUOTES, 'UTF-8') ?>"
                    class="text-gray-300 hover:text-white transition">
                    <i class="fab fa-github text-2xl"></i>
                </a>
            </div>
        </div>

        <!-- Modal -->
        <div x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 backdrop-blur-sm"
            @click.self="isModalOpen = false">
            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 relative">
                <!-- Close Button -->
                <button @click="isModalOpen = false"
                    class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Header -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Let's Work Together!</h3>
                    <p class="text-gray-500 mt-1">I'll get back to you soon</p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submitForm" class="space-y-4">
                    <input type="hidden" name="csrf_token" :value="csrfToken">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" x-model="form.subject" placeholder="Subject"
                            class="text-black w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                            required />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" x-model="form.email" placeholder="your@email.com"
                            class="text-black w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                            required />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea x-model="form.message" placeholder="Your message here..." rows="4"
                            class="text-black w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                            required></textarea>
                    </div>

                    <button type="submit" :disabled="isSubmitting"
                        class="w-full bg-gradient-to-r from-gray-800 to-gray-700 text-white py-3 px-6 rounded-lg font-medium hover:opacity-90 transition-opacity shadow-lg disabled:opacity-70">
                        <span x-text="isSubmitting ? 'Sending...' : 'Send Message'"></span>
                    </button>

                    <!-- Success Message -->
                    <div x-show="isSuccess" x-transition
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        Message sent successfully!
                    </div>

                    <!-- Error Message -->
                    <div x-show="errorMessage" x-transition
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <span x-text="errorMessage"></span>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactComponent', () => ({
                isModalOpen: false,
                isSubmitting: false,
                isSuccess: false,
                errorMessage: '',
                form: {
                    subject: '',
                    email: '',
                    message: ''
                },
                csrfToken: document.querySelector('meta[name="csrf-token"]')?.content,
                csrfName: document.querySelector('meta[name="csrf-token-name"]')?.content,

                async submitForm() {
                    if (this.isSubmitting) return;

                    this.isSubmitting = true;
                    this.errorMessage = '';
                    this.isSuccess = false;

                    try {
                        const formData = new FormData();
                        formData.append('subject', this.form.subject);
                        formData.append('email', this.form.email);
                        formData.append('message', this.form.message);

                        if (this.csrfToken && this.csrfName) {
                            formData.append(this.csrfName, this.csrfToken);
                        }

                        const response = await fetch('<?= site_url('contact-me') ?>', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken || ''
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Failed to send message');
                        }

                        if (data.csrf_token) {
                            this.updateCsrfToken(data.csrf_token);
                        }

                        this.isSuccess = true;
                        this.form = {
                            subject: '',
                            email: '',
                            message: ''
                        };

                        setTimeout(() => {
                            this.isSuccess = false;
                            this.isModalOpen = false;
                        }, 5000);

                    } catch (error) {
                        console.error('Error:', error);
                        this.errorMessage = error.message ||
                            'Something went wrong. Please try again.';
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                updateCsrfToken(newToken) {
                    if (newToken) {
                        this.csrfToken = newToken;
                        const metaTag = document.querySelector('meta[name="csrf-token"]');
                        if (metaTag) metaTag.content = newToken;

                        const csrfInput = document.querySelector('input[name="csrf_token"]');
                        if (csrfInput) csrfInput.value = newToken;
                    }
                }
            }));
        });
    </script>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-white text-gray-900 p-3 rounded-full shadow-lg hover:bg-gray-200 transition hidden">↑</button>

    <script src="<?= base_url() ?>assets/frontend/js/scripts.js"></script>
    <?= $footer ?>
</body>

</html>