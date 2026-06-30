<?= $header ?>

<body class="bg-gray-900 text-gray-100 font-sans">

    <!-- Navigation -->
    <nav class="bg-gray-800/90 backdrop-blur-md py-4 sticky top-0 z-50 shadow-[1px_1px_2px_white]">
        <div class="content-container px-6 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-white flex items-center">
                <span class="bg-gradient-to-r from-lime-400 to-cyan-400 bg-clip-text text-transparent"><?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-300 hover:text-white transition duration-300">Home</a>
                <a href="#skills" class="text-gray-300 hover:text-white transition duration-300">Skills</a>
                <a href="#projects" class="text-gray-300 hover:text-white transition duration-300">Projects</a>
                <a href="#blog" class="text-gray-300 hover:text-white transition duration-300">Blog</a>
                <a href="#about" class="text-gray-300 hover:text-white transition duration-300">About</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition duration-300">Contact</a>
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
                <a href="#blog" class="text-gray-300 hover:text-white transition duration-300 py-2">Blog</a>
                <a href="#about" class="text-gray-300 hover:text-white transition duration-300 py-2">About</a>
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

    <!-- Header Section -->
    <header class="header-bg relative py-32 text-center text-white overflow-hidden">
        <div class="header-overlay absolute inset-0"></div>
        <div class="circle-transition"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-64 h-64 bg-white/10 rounded-full animate-pulse"></div>
            <div class="w-96 h-96 bg-white/5 rounded-full absolute animate-pulse delay-500"></div>
        </div>
        <div class="header-content container mx-auto px-6 relative z-20">
            <h1 class="text-5xl font-bold mb-4"><?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="text-xl mb-8">Web Application | Software Engineering | ERP Implementation | Server Administrator</p>
            <a href="#contact" class="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">Connect Me</a>
        </div>
    </header>

    <!-- Loading Animation -->
    <div id="loading" class="fixed inset-0 bg-gray-900 flex items-center justify-center z-50">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-white"></div>
    </div>

    <!-- About Section -->
    <section id="about" class="relative py-20 overflow-hidden">
        <canvas id="matrix-canvas" class="absolute inset-0 z-0"></canvas>
        <div class="container mx-auto px-6 text-center max-w-6xl relative z-10">
            <h2 class="text-4xl font-bold text-white mb-6">About Me</h2>
            <p class="text-lg text-gray-300 leading-relaxed bg-gray-800/80 backdrop-blur-sm p-8 rounded-3xl shadow-lg">
                Self-motivated and experienced software engineer with over six years of expertise in developing web applications and websites using technologies like Laravel, React JS and Python. Proficient in building diverse applications ranging from simple tools to complex management systems, with a strong track record in leading teams, managing projects, and delivering high-quality results. I am seeking opportunities to apply my skills to innovative projects and contribute to the success of forward-thinking companies while continuing to grow professionally.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed bg-gray-800/80 backdrop-blur-sm p-8 rounded-3xl shadow-lg mt-4">
                Being A Software Engineer is my childhood dream. I can still remember those days I was used to playing with Visual Basic, C, and Symbion OS. Learning HTML was my first step and PHP is the first programming language that I like. I am still impressed by It is syntax and simplicity. Recently I am working on Business-Focused Software.
            </p>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="bg-gray-800 py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-6 text-center">Skills</h2>
            <p class="text-gray-400 text-center mb-12">Skills come with daily experience.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-code text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Web Architect</h3>
                    <p class="text-gray-300 mt-2">Designing and building scalable web architectures</p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-cubes text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Server Management</h3>
                    <p class="text-gray-300 mt-2">Managing and maintaining server infrastructure</p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-book text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Web Application</h3>
                    <p class="text-gray-300 mt-2">Building robust web applications end to end</p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-database text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Database Design</h3>
                    <p class="text-gray-300 mt-2">Designing efficient database schemas and queries</p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-bolt text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Project Management</h3>
                    <p class="text-gray-300 mt-2">Leading teams and delivering projects on time</p>
                </div>
                <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                    <i class="fa fa-cog text-4xl text-white"></i>
                    <h3 class="text-xl font-semibold mt-4 text-white">Business Software</h3>
                    <p class="text-gray-300 mt-2">Developing business-focused software solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="relative bg-gray-900 py-24 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-stripes.png')] opacity-20"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-5xl font-bold text-white mb-6">Let's Work Together!</h2>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">Engineers are introverts. However, I would love to meet new people.</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                <a href="mailto:<?= htmlspecialchars($settings['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition transform hover:scale-105 shadow-lg">
                    Email Me
                </a>
                <a href="#projects" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition transform hover:scale-105">
                    View My Work
                </a>
            </div>
        </div>
    </section>

    <script src="<?= base_url() ?>assets/frontend/js/scripts.js"></script>
    <?= $footer ?>
</body>
</html>
