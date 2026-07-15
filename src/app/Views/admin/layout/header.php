<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - Admin</title>
    <link rel="stylesheet"
        href="<?= base_url('assets/frontend/css/tailwind.css') . '?v=' . filemtime(FCPATH . 'assets/frontend/css/tailwind.css') ?>" />


    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= base_url('assets/images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= base_url('assets/images/favicon/favicon-32x32.png') ?>">
    <link rel="manifest" href="<?= base_url('assets/images/favicon/site.webmanifest') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon/favicon.ico') ?>">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?= $extraHead ?? '' ?>
</head>

<body class="bg-gray-900 text-gray-100 font-sans">

    <div id="toast" class="hidden fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-sm font-medium shadow-lg"></div>

    <div class="flex h-screen overflow-hidden">
        <?= view('admin/layout/sidebar', ['currentPage' => $currentPage]) ?>

        <div class="flex-1 flex flex-col min-w-0">
            <?= view('admin/layout/topbar', ['pageTitle' => $pageTitle, 'unreadCount' => $unreadCount, 'user' => $user]) ?>

            <main class="flex-1 overflow-y-auto p-6">