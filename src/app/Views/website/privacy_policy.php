<?= $header ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .gradient-text {
        background: linear-gradient(90deg, #3B82F6 0%, #8B5CF6 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .article-tag {
        transition: all 0.2s ease;
    }

    .article-tag:hover {
        transform: translateY(-1px);
    }

    .related-article:hover img {
        transform: scale(1.05);
    }

    /* Mobile menu animation */
    .mobile-menu {
        transition: all 0.3s ease-in-out;
        transform: translateY(-150%);
    }

    .mobile-menu.active {
        transform: translateY(0);
    }

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
</style>

<body class="font-sans bg-gray-50 text-gray-800">
    <!-- Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200" x-data="{ mobileMenuOpen: false }">
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
                        <a href="<?= base_url() ?>#skills" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Skills</a>
                        <a href="<?= base_url() ?>#projects" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Projects</a>
                        <a href="<?= base_url() ?>#articles" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Articles</a>
                        <a href="<?= base_url() ?>#about" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">About</a>
                        <a href="<?= base_url() ?>#contactMessageLink" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">Contact</a>
                    </nav>
                </div>

                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-gray-900 focus:outline-none" aria-label="Toggle menu">
                        <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                        <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="fixed inset-x-0 top-16 z-40 bg-white shadow-lg border-b border-gray-200 md:hidden">
            <div class="container mx-auto px-4 py-2">
                <nav class="flex flex-col space-y-2">
                    <a href="<?= base_url() ?>" @click="mobileMenuOpen = false" class="text-primary-600 font-medium px-3 py-2 rounded-md">Home</a>
                    <a href="<?= base_url() ?>#skills" @click="mobileMenuOpen = false" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Skills</a>
                    <a href="<?= base_url() ?>#projects" @click="mobileMenuOpen = false" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Projects</a>
                    <a href="<?= base_url() ?>#articles" @click="mobileMenuOpen = false" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">My Articles</a>
                    <a href="<?= base_url() ?>#about" @click="mobileMenuOpen = false" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">About</a>
                    <a href="<?= base_url() ?>#contactMessageLink" @click="mobileMenuOpen = false" class="text-gray-600 hover:text-gray-900 font-medium px-3 py-2 rounded-md">Contact</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Article Header -->
    <section class="py-20 bg-gradient-to-br from-lime-100 via-white to-lime-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <div class="text-center">
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight text-black animate-fade-in">
                    <?= htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8') ?>
                </h1>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mt-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Article Content -->
            <div class="container mt-10 mx-auto px-4 sm:px-6 lg:px-8 max-w-full">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Article Content -->
                    <main class="w-full">
                        <div class="article-content">
                            <p class="text-gray-600 mb-8">Last Updated: May 14, 2025</p>

                            <p class="mb-6">Thank you for visiting <strong>obydullah.com</strong>. Your privacy is important to me. This Privacy Policy explains how I collect, use, and protect any information that you may provide while browsing this website.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Information I Collect</h2>
                            <p class="mb-6">I do not collect personal information unless you explicitly choose to provide it. Here are the types of information that may be collected:</p>

                            <ul class="list-disc pl-6 mb-6">
                                <li><strong>Contact Form Data:</strong> If you send a message through the contact form, your name, email, and message content will be stored securely for the purpose of communication only.</li>
                                <li><strong>Usage Data:</strong> Basic analytics data (such as page views, time on site, browser type) may be collected through third-party tools like Google Analytics to understand how visitors use the site. This data is anonymous and does not include personal identifiers.</li>
                            </ul>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">How I Use Your Information</h2>
                            <p class="mb-6">The information collected is used solely for the following purposes:</p>
                            <ul class="list-disc pl-6 mb-6">
                                <li>To respond to inquiries or messages sent through the contact form</li>
                                <li>To improve the design, content, and functionality of the website</li>
                                <li>To monitor website traffic and usage trends (via analytics)</li>
                            </ul>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Cookies</h2>
                            <p class="mb-6">This site may use cookies to enhance user experience and collect statistical data. You can choose to disable cookies through your browser settings. Disabling cookies will not prevent access to this site.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Third-Party Services</h2>
                            <p class="mb-6">This website may use third-party services such as:</p>

                            <ul class="list-disc pl-6 mb-6">
                                <li><strong>Google Analytics:</strong> For anonymous website usage statistics</li>
                                <li><strong>FontAwesome & Google Fonts:</strong> For UI elements and typography</li>
                            </ul>

                            <p class="mb-6">These third-party tools may collect data according to their own privacy policies, which are independent of obydullah.com.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Data Security</h2>
                            <p class="mb-6">I take reasonable precautions to protect the information you share through this site. However, no method of transmission over the internet is 100% secure.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Your Rights</h2>
                            <p class="mb-6">If you have submitted any personal information (e.g., via the contact form) and would like to request its deletion, please contact me directly.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Changes to This Privacy Policy</h2>
                            <p class="mb-6">This policy may be updated occasionally to reflect changes in practices or legal requirements. The latest version will always be available on this page.</p>

                            <h2 class="text-2xl font-semibold mt-8 mb-4">Contact</h2>
                            <p class="mb-6">If you have any questions or concerns regarding this privacy policy, feel free to reach out via the contact form <a href="https://obydullah.com/#contactMessageLink" class="text-blue-500 hover:underline">here</a>.</p>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-white text-gray-900 p-3 rounded-full shadow-lg hover:bg-gray-200 transition hidden">↑</button>

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