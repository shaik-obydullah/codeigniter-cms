<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <div class="text-9xl font-bold bg-gradient-to-r from-lime-400 to-cyan-400 bg-clip-text text-transparent mb-4">404</div>
        <h1 class="text-4xl font-bold text-white mb-4">Page Not Found</h1>
        <p class="text-lg text-gray-400 mb-8 max-w-md mx-auto">The page you are looking for doesn't exist or has been moved.</p>
        <a href="<?= base_url() ?>" class="inline-flex items-center bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition transform hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i> Back to Home
        </a>
    </div>
</body>
</html>
