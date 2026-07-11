<?= view('layout/header', ['title' => '404 - Page Not Found']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <h1 class="text-8xl md:text-9xl font-bold text-lime-500">404</h1>
        <h2 class="text-2xl md:text-3xl font-bold text-white mt-4">Page Not Found</h2>
        <p class="text-gray-400 mt-3 max-w-md mx-auto">The page you're looking for doesn't exist or has been moved. Let's get you back on track.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
            <a href="/" class="bg-lime-500 text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-lime-400 transition">Go Home</a>
            <a href="/contact" class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">Contact Me</a>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
