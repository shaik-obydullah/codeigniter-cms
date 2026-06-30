<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Shaik Obydullah" />
    <meta name="description" content="<?= $metaDescription ?? 'Shaik Obydullah - Software Engineer specializing in Laravel, Next.js, and MySQL.' ?>" />
    <meta name="keywords" content="<?= $metaKeywords ?? 'portfolio, software engineer, Laravel, Next.js, MySQL' ?>" />
    <title><?= $title ?? 'Shaik Obydullah - Portfolio' ?></title>
    <link rel="icon" type="image/png" href="/favicon.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php if (isset($extraStyles)) echo $extraStyles; ?>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

<div id="loading" class="fixed inset-0 bg-gray-900 flex items-center justify-center z-50">
    <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-white"></div>
</div>

<nav id="navbar" class="fixed top-0 left-0 w-full z-40 bg-gray-900/90 backdrop-blur-md border-b border-gray-700/50 transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <a href="/" class="text-xl font-bold text-white">Shaik Obydullah</a>
        <ul class="hidden md:flex space-x-8 text-gray-300 font-medium">
            <li><a href="/about" class="<?= $activeNav === 'about' ? 'text-lime-500' : 'hover:text-white' ?> transition">About</a></li>
            <li><a href="/#skills" class="hover:text-white transition">Skills</a></li>
            <li><a href="/projects" class="<?= $activeNav === 'projects' ? 'text-lime-500' : 'hover:text-white' ?> transition">Projects</a></li>
            <li><a href="/articles" class="<?= $activeNav === 'articles' ? 'text-lime-500' : 'hover:text-white' ?> transition">Articles</a></li>
            <li><a href="/#contact" class="hover:text-white transition">Contact</a></li>
        </ul>
        <button id="menu-toggle" class="md:hidden text-white focus:outline-none" aria-label="Toggle menu">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
    <div id="mobile-menu" class="hidden md:hidden bg-gray-900/95 backdrop-blur-md border-t border-gray-700/50">
        <ul class="flex flex-col items-center space-y-4 py-6 text-gray-300 font-medium">
            <li><a href="/about" class="<?= $activeNav === 'about' ? 'text-lime-500' : 'hover:text-white' ?> transition">About</a></li>
            <li><a href="/#skills" class="hover:text-white transition">Skills</a></li>
            <li><a href="/projects" class="<?= $activeNav === 'projects' ? 'text-lime-500' : 'hover:text-white' ?> transition">Projects</a></li>
            <li><a href="/articles" class="<?= $activeNav === 'articles' ? 'text-lime-500' : 'hover:text-white' ?> transition">Articles</a></li>
            <li><a href="/#contact" class="hover:text-white transition">Contact</a></li>
        </ul>
    </div>
</nav>
