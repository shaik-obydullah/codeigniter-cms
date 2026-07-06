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
        <a href="/projects"
            class="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">View My
            Work</a>
    </div>
</header>

<section id="about" class="relative py-20 overflow-hidden">
    <canvas id="matrix-canvas"></canvas>
    <div class="container mx-auto px-6 text-center max-w-4xl relative z-10">
        <h2 class="text-4xl font-bold text-white mb-6">About Me</h2>
        <p class="text-lg text-gray-300 leading-relaxed bg-gray-800/80 backdrop-blur-sm p-8 rounded-3xl shadow-lg">I am
            a Full Stack Software Engineer and Cloud Computing specialist with expertise in designing and implementing
            scalable, business-driven solutions. With a strong foundation in PHP, JavaScript frameworks, and database
            management, I specialize in building end-to-end web applications while analyzing business requirements to
            deliver efficient systems. My experience in cloud platforms allows me to design and deploy modern,
            cost-effective infrastructure. I am passionate about leveraging technology to solve complex problems and
            drive business growth. </p>
    </div>
</section>

<section id="skills" class="bg-gray-800 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-6 text-center">Skills</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($skills)): ?>
            <?php foreach ($skills as $skill): ?>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center hover:scale-105 transition-transform">
                <i class="<?= esc($skill->icon ?? 'fas fa-code') ?> text-4xl text-white"></i>
                <h3 class="text-xl font-semibold mt-4 text-white"><?= esc($skill->name) ?></h3>
                <p class="text-gray-300 mt-2"><?= esc($skill->description ?? '') ?></p>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No skills added yet.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="projects" class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Projects</h2>

        <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
            <div class="project-card bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform"
                data-tags="<?= esc($project->tags_str ?? '') ?>">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-gray-700 text-white px-3 py-1 rounded-full text-sm"><?= esc($project->category_name ?? 'Project') ?></span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2"><?= esc($project->title) ?></h3>
                    <p class="text-gray-300 mb-4"><?= esc($project->excerpt ?? $project->description ?? '') ?></p>
                    <a href="/projects/<?= esc($project->slug) ?>"
                        class="text-lime-500 hover:text-lime-400 font-semibold inline-block">View Project &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No projects published yet.</div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-10">
            <a href="/projects"
                class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">View
                All Projects</a>
        </div>
    </div>
</section>

<section id="blog" class="bg-gray-800 py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-white mb-8 text-center">Articles</h2>

        <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
            <article
                class="article-card bg-gray-700 rounded-lg shadow-lg border-l-4 border-lime-500 hover:border-lime-400 transition-colors hover:shadow-xl hover:scale-105 transform transition-transform"
                data-tags="<?= esc($article->tags_str ?? '') ?>">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm"><?= esc($article->category_name ?? 'Article') ?></span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2"><?= esc($article->title) ?></h3>
                    <p class="text-gray-300 mb-4"><?= esc($article->excerpt ?? '') ?></p>
                    <a href="/articles/<?= esc($article->slug) ?>"
                        class="text-lime-500 hover:text-lime-400 font-semibold inline-block">Read More &rarr;</a>
                </div>
            </article>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No articles published yet.</div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-10">
            <a href="/articles"
                class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">View
                All Articles</a>
        </div>
    </div>
</section>

<section id="contact" class="relative bg-gray-900 py-24 overflow-hidden">
    <div
        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-stripes.png')] opacity-20 animate-moveBackground">
    </div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-5xl font-bold text-white mb-6">Let's Work Together!</h2>
        <p class="text-lg text-gray-300 mb-12 max-w-2xl mx-auto">I'm always excited to collaborate on new projects,
            explore job opportunities, or just chat about ideas. Reach out, and let's create something extraordinary
            together!</p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
            <a href="mailto:contact@obydullah.com"
                class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-gray-200 transition transform hover:scale-105 shadow-lg">Email
                Me</a>
            <a href="/projects"
                class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition transform hover:scale-105">View
                My Work</a>
        </div>
        <div class="mt-12 flex justify-center space-x-6">
            <a href="#" class="text-gray-300 hover:text-white transition"><i
                    class="fab fa-linkedin-in text-2xl"></i></a>
            <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-github text-2xl"></i></a>
            <a href="#" class="text-gray-300 hover:text-white transition"><i class="fab fa-twitter text-2xl"></i></a>
        </div>
    </div>
</section>

<?= view('layout/footer', ['extraScripts' => '
<script>
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