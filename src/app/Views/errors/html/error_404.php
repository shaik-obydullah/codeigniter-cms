<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        #loading { display: none; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans min-h-screen flex flex-col">

    <nav class="fixed top-0 left-0 w-full z-40 bg-gray-900/90 backdrop-blur-md border-b border-gray-700/50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-white">Shaik Obydullah</a>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center pt-20">
        <div class="text-center px-6">
            <h1 class="text-8xl md:text-9xl font-bold text-lime-500">404</h1>
            <h2 class="text-2xl md:text-3xl font-bold text-white mt-4">Page Not Found</h2>
            <p class="text-gray-400 mt-3 max-w-md mx-auto"><?php if (ENVIRONMENT !== 'production') : ?><?= nl2br(esc($message ?? '')) ?><?php else : ?>The page you're looking for doesn't exist or has been moved. Let's get you back on track.<?php endif; ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="/" class="bg-lime-500 text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-lime-400 transition">Go Home</a>
                <a href="/contact" class="bg-gray-700 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-600 transition">Contact Me</a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800/50 border-t border-gray-700/50 py-6 text-center">
        <p class="text-gray-500 text-sm">&copy; <?= date('Y') ?> Shaik Obydullah. All rights reserved.</p>
    </footer>

</body>
</html>
