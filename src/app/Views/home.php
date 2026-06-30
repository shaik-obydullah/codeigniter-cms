<?= view('layout/header', ['activeNav' => 'home']) ?>

<header class="header-bg header-wrapper relative pt-36 pb-32 text-center text-white overflow-hidden">
    <div class="header-overlay absolute inset-0"></div>
    <div class="circle-transition"></div>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="w-64 h-64 bg-white/10 rounded-full animate-pulse"></div>
        <div class="w-96 h-96 bg-white/5 rounded-full absolute animate-pulse delay-500"></div>
    </div>
    <div class="header-content container mx-auto px-6 relative z-20">
        <h1 class="text-5xl font-bold mb-4">Shaik Obydullah</h1>
        <p class="text-xl mb-8 typed-text">Software Engineer | Laravel | Next.js | MySQL</p>
        <a href="/projects" class="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">View My Work</a>
    </div>
</header>

<section id="about" class="relative py-20 overflow-hidden">
    <canvas id="matrix-canvas"></canvas>
    <div class="container mx-auto px-6 text-center max-w-4xl relative z-10">
        <h2 class="text-4xl font-bold text-white mb-6">About Me</h2>
        <p class="text-lg text-gray-300 leading-relaxed bg-gray-800/80 backdrop-blur-sm p-8 rounded-3xl shadow-lg">I am a passionate software engineer with expertise in <strong>Laravel</strong>, <strong>Next.js</strong>, and <strong>MySQL</strong>. I specialize in building scalable, high-performance web applications that solve real-world problems. With over 5 years of experience, I've worked on projects ranging from simple tools to complex management systems.</p>
    </div>
</section>

<section id="skills" class="bg-gray-800 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-6 text-center">Skills</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                <i class="fab fa-laravel text-4xl text-white"></i>
                <h3 class="text-xl font-semibold mt-4 text-white">Laravel</h3>
                <p class="text-gray-300 mt-2">Expert in building robust backend systems with Laravel.</p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                <i class="fab fa-js-square text-4xl text-white"></i>
                <h3 class="text-xl font-semibold mt-4 text-white">Next.js</h3>
                <p class="text-gray-300 mt-2">Proficient in building fast, SEO-friendly frontends with Next.js.</p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                <i class="fas fa-database text-4xl text-white"></i>
                <h3 class="text-xl font-semibold mt-4 text-white">MySQL</h3>
                <p class="text-gray-300 mt-2">Skilled in designing and optimizing MySQL databases.</p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                <i class="fab fa-react text-4xl text-white"></i>
                <h3 class="text-xl font-semibold mt-4 text-white">React</h3>
                <p class="text-gray-300 mt-2">Experienced in building dynamic user interfaces with React.</p>
            </div>
        </div>
    </div>
</section>

<section id="projects" class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Projects</h2>
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button data-filter="all" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-lime-500 text-gray-900">All</button>
            <button data-filter="Laravel" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Laravel</button>
            <button data-filter="Next.js" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Next.js</button>
            <button data-filter="MySQL" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">MySQL</button>
            <button data-filter="React" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">React</button>
            <button data-filter="Vue.js" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Vue.js</button>
            <button data-filter="API" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">API</button>
            <button data-filter="Tailwind" class="project-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Tailwind</button>
        </div>
        <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Laravel,MySQL,Payment Gateway">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=E-Commerce+Platform" alt="E-Commerce Platform" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">E-Commerce Platform</h3>
                    <p class="text-gray-300 mb-4">Built with Laravel and MySQL. Features include product management, cart, and payment integration.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Payment Gateway</span>
                    </div>
                    <a href="/projects/e-commerce-platform" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Next.js,Laravel,Markdown">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Blog+CMS" alt="Blog CMS" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Blog CMS</h3>
                    <p class="text-gray-300 mb-4">A content management system built with Next.js and Laravel.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Next.js</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Markdown</span>
                    </div>
                    <a href="/projects/blog-cms" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Next.js,MySQL,Drag & Drop">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Task+Management+App" alt="Task Management App" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Task Management App</h3>
                    <p class="text-gray-300 mb-4">A task management tool built with Next.js and MySQL.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Next.js</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Drag & Drop</span>
                    </div>
                    <a href="/projects/task-management-app" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Laravel,Livewire,MySQL">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Inventory+System" alt="Inventory System" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Inventory Management System</h3>
                    <p class="text-gray-300 mb-4">Real-time inventory tracking with Laravel and Livewire.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Livewire</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                    </div>
                    <a href="/projects/inventory-system" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="Next.js,Laravel,Map API">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Real+Estate+Portal" alt="Real Estate Portal" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Real Estate Portal</h3>
                    <p class="text-gray-300 mb-4">Property listing platform with search, filters, and map integration.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Next.js</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Map API</span>
                    </div>
                    <a href="/projects/real-estate-portal" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform" data-tags="React,Chart.js,Laravel">
                <img src="https://placehold.co/400x200/4A5568/FFFFFF/png?text=Analytics+Dashboard" alt="Analytics Dashboard" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Analytics Dashboard</h3>
                    <p class="text-gray-300 mb-4">Data visualization dashboard with real-time charts and reporting.</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">React</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Chart.js</span>
                        <span class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                    </div>
                    <a href="/projects/analytics-dashboard" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-10">
            <a href="/projects" class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">View All Projects</a>
        </div>
    </div>
</section>

<section id="blog" class="bg-gray-800 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Articles</h2>
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button data-filter="all" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-lime-500 text-gray-900">All</button>
            <button data-filter="UML" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">UML</button>
            <button data-filter="Laravel" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Laravel</button>
            <button data-filter="Next.js" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Next.js</button>
            <button data-filter="MySQL" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">MySQL</button>
            <button data-filter="Tutorial" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">Tutorial</button>
            <button data-filter="API" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">API</button>
            <button data-filter="React" class="article-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-gray-700 text-white hover:bg-gray-600">React</button>
        </div>
        <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="UML,Diagrams">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">UML</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Diagrams</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Activity Diagram Overview</h3>
                    <p class="text-gray-300 mb-4">Learn how to create activity diagrams for your projects.</p>
                    <a href="/articles/activity-diagram-overview" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="UML,Diagrams">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">UML</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Diagrams</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Collaboration Diagram Overview</h3>
                    <p class="text-gray-300 mb-4">Understand collaboration diagrams in UML.</p>
                    <a href="/articles/collaboration-diagram-overview" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="UML,Diagrams">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">UML</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Diagrams</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Sequence Diagram Overview</h3>
                    <p class="text-gray-300 mb-4">Explore sequence diagrams and their uses.</p>
                    <a href="/articles/sequence-diagram-overview" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="Laravel,Tutorial">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Laravel</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Tutorial</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Getting Started with Laravel</h3>
                    <p class="text-gray-300 mb-4">A beginner-friendly guide to building your first Laravel application.</p>
                    <a href="/articles/getting-started-with-laravel" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="Next.js,Tutorial">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Next.js</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Tutorial</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Next.js for Beginners</h3>
                    <p class="text-gray-300 mb-4">Learn the fundamentals of Next.js and server-side rendering.</p>
                    <a href="/articles/nextjs-for-beginners" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <article class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform" data-tags="MySQL,Tutorial">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">MySQL</span>
                        <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">Tutorial</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">MySQL Query Optimization</h3>
                    <p class="text-gray-300 mb-4">Tips and techniques for writing faster MySQL queries.</p>
                    <a href="/articles/mysql-query-optimization" class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
        </div>
        <div class="text-center mt-10">
            <a href="/articles" class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">View All Articles</a>
        </div>
    </div>
</section>

<section id="contact" class="relative bg-gray-900 py-24 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-stripes.png')] opacity-20 animate-moveBackground"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl font-bold text-white mb-6">Let's Work Together!</h2>
        <p class="text-lg text-gray-300 mb-12 max-w-2xl mx-auto">I'm always excited to collaborate on new projects, explore job opportunities, or just chat about ideas. Reach out, and let's create something extraordinary together!</p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
            <a href="mailto:contact@obydullah.com" class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition transform hover:scale-105 shadow-lg">Email Me</a>
            <a href="/projects" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition transform hover:scale-105">View My Work</a>
        </div>
        <div class="mt-12 flex justify-center space-x-6">
            <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-linkedin-in text-2xl"></i></a>
            <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-github text-2xl"></i></a>
            <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-twitter text-2xl"></i></a>
        </div>
    </div>
</section>

<?= view('layout/footer', ['extraScripts' => '
<script>
const projectFilterBtns = document.querySelectorAll(".project-filter-btn");
const projectCards = document.querySelectorAll(".project-card");
projectFilterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        projectFilterBtns.forEach((b) => { b.classList.remove("bg-lime-500", "text-gray-900"); b.classList.add("bg-gray-700", "text-white"); });
        btn.classList.remove("bg-gray-700", "text-white");
        btn.classList.add("bg-lime-500", "text-gray-900");
        const activeFilter = btn.dataset.filter;
        projectCards.forEach((card) => {
            const tags = card.dataset.tags;
            if (activeFilter === "all" || tags.includes(activeFilter)) card.classList.remove("hidden");
            else card.classList.add("hidden");
        });
    });
});

const articleFilterBtns = document.querySelectorAll(".article-filter-btn");
const articleCards = document.querySelectorAll(".article-card");
articleFilterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        articleFilterBtns.forEach((b) => { b.classList.remove("bg-lime-500", "text-gray-900"); b.classList.add("bg-gray-700", "text-white"); });
        btn.classList.remove("bg-gray-700", "text-white");
        btn.classList.add("bg-lime-500", "text-gray-900");
        const activeFilter = btn.dataset.filter;
        articleCards.forEach((card) => {
            const tags = card.dataset.tags;
            if (activeFilter === "all" || tags.includes(activeFilter)) card.classList.remove("hidden");
            else card.classList.add("hidden");
        });
    });
});

const matrixCanvas = document.getElementById("matrix-canvas");
if (matrixCanvas) {
    const ctx = matrixCanvas.getContext("2d");
    matrixCanvas.width = window.innerWidth;
    matrixCanvas.height = window.innerHeight;
    const binary = "01010101010101010101010101010101";
    const columns = Math.floor(matrixCanvas.width / 20);
    const drops = Array(columns).fill(0);
    function drawMatrix() {
        ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
        ctx.fillRect(0, 0, matrixCanvas.width, matrixCanvas.height);
        ctx.fillStyle = "lime";
        ctx.font = "15px monospace";
        for (let i = 0; i < drops.length; i++) {
            const text = binary[Math.floor(Math.random() * binary.length)];
            ctx.fillText(text, i * 20, drops[i] * 20);
            if (drops[i] * 20 > matrixCanvas.height && Math.random() > 0.975) drops[i] = 0;
            drops[i]++;
        }
    }
    setInterval(drawMatrix, 50);
    window.addEventListener("resize", () => { matrixCanvas.width = window.innerWidth; matrixCanvas.height = window.innerHeight; });
}
</script>
']) ?>
