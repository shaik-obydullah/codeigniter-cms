<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Shaik Obydullah" />
    <meta name="description" content="<?= $metaDescriptio ?? '' ?>" />
    <meta name="keywords" content="<?= $metaKeywords ?? '' ?>" />
    <title><?= $title ?? '' ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= base_url('public/assets/images/favicon/favicon.svg') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/frontend/css/tailwind.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/assets/frontend/css/base.css') ?>" />
    <link rel="stylesheet"
        href="<?= base_url('public/assets/frontend/css/theme.css') . '?v=' . filemtime(FCPATH . 'assets/frontend/css/theme.css') ?>" />

    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= base_url('public/assets/images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= base_url('public/assets/images/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?= base_url('public/assets/images/favicon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('public/assets/images/favicon/site.webmanifest') ?>">
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon/favicon.ico') ?>">
</head>

<body class="bg-gray-900 text-gray-100 font-sans">

    <div id="loading">
        <div class="spinner"></div>
    </div>

    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-40 bg-gray-900/90 backdrop-blur-md border-b border-gray-700/50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-white">Shaik Obydullah</a>
            <ul class="hidden md:flex space-x-8 text-gray-300 font-medium">
                <li><a href="/about"
                        class="<?= ($activeNav ?? '') === 'about' ? 'text-lime-500' : 'hover:text-white' ?> transition">About</a>
                </li>
                <li><a href="/#skills" class="hover:text-white transition">Skills</a></li>
                <li><a href="/projects"
                        class="<?= ($activeNav ?? '') === 'projects' ? 'text-lime-500' : 'hover:text-white' ?> transition">Projects</a>
                </li>
                <li><a href="/articles"
                        class="<?= ($activeNav ?? '') === 'articles' ? 'text-lime-500' : 'hover:text-white' ?> transition">Articles</a>
                </li>
                <li><a href="/documentation"
                        class="<?= ($activeNav ?? '') === 'documentation' ? 'text-lime-500' : 'hover:text-white' ?> transition">Documentation</a>
                </li>
                <li><a href="/contact"
                        class="<?= ($activeNav ?? '') === 'contact' ? 'text-lime-500' : 'hover:text-white' ?> transition">Contact</a>
                </li>
                <?php if (auth()->loggedIn()): ?>
                <li><a href="/dashboard" class="font-semibold">Dashboard</a></li>
                <?php else: ?>
                <li><a href="/user-login" class="hover:text-white transition">Login</a></li>
                <li><a href="/user-register"
                        class="bg-lime-500 text-gray-900 px-4 py-1.5 rounded-lg hover:bg-lime-400 transition font-semibold">Register</a>
                </li>
                <?php endif; ?>
            </ul>
            <button id="menu-toggle" class="md:hidden text-white focus:outline-none relative w-6 h-6"
                aria-label="Toggle menu">
                <span class="menu-bar top"></span>
                <span class="menu-bar middle"></span>
                <span class="menu-bar bottom"></span>
            </button>
        </div>
        <div id="mobile-menu"
            class="md:hidden max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-gray-900/95 backdrop-blur-md border-t border-gray-700/50">
            <ul class="flex flex-col items-center space-y-4 py-6 text-gray-300 font-medium">
                <li><a href="/about"
                        class="<?= ($activeNav ?? '') === 'about' ? 'text-lime-500' : 'hover:text-white' ?> transition">About</a>
                </li>
                <li><a href="/#skills" class="hover:text-white transition">Skills</a></li>
                <li><a href="/projects"
                        class="<?= ($activeNav ?? '') === 'projects' ? 'text-lime-500' : 'hover:text-white' ?> transition">Projects</a>
                </li>
                <li><a href="/articles"
                        class="<?= ($activeNav ?? '') === 'articles' ? 'text-lime-500' : 'hover:text-white' ?> transition">Articles</a>
                </li>
                <li><a href="/documentation"
                        class="<?= ($activeNav ?? '') === 'documentation' ? 'text-lime-500' : 'hover:text-white' ?> transition">Documentation</a>
                </li>
                <li><a href="/contact"
                        class="<?= ($activeNav ?? '') === 'contact' ? 'text-lime-500' : 'hover:text-white' ?> transition">Contact</a>
                </li>
                <?php if (auth()->loggedIn()): ?>
                <li><a href="/dashboard" class="transition">Dashboard</a></li>
                <?php else: ?>
                <li><a href="/user-login" class="hover:text-white transition">Login</a></li>
                <li><a href="/user-register" class="hover:text-white transition">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>