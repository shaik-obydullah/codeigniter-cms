<?= view('layout/header', ['title' => 'Site Under Maintenance']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <h1 class="text-6xl md:text-7xl font-bold text-lime-500 mb-4"><i class="fas fa-wrench"></i></h1>
        <h2 class="text-2xl md:text-3xl font-bold text-white mt-4">Under Maintenance</h2>
        <p class="text-gray-400 mt-3 max-w-md mx-auto">We're currently performing scheduled maintenance. We'll be back shortly. Thank you for your patience.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
            <a href="/" class="bg-lime-500 text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-lime-400 transition">Try Again</a>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
