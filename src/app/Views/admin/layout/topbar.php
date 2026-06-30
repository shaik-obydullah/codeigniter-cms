<header class="bg-gray-800 border-b border-gray-700 px-6 py-3 flex items-center justify-between shrink-0">
    <div class="flex items-center gap-4">
        <button class="text-gray-400 hover:text-white lg:hidden sidebar-toggle"><i class="fas fa-bars text-xl"></i></button>
        <h2 class="text-white font-semibold text-lg"><?= $pageTitle ?></h2>
    </div>
    <div class="flex items-center gap-4">
        <a href="<?= site_url('/admin/notifications') ?>" class="text-gray-400 hover:text-white relative">
            <i class="fas fa-bell text-lg"></i>
            <?php if ($unreadCount > 0): ?>
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-[10px] flex items-center justify-center text-white font-medium"><?= $unreadCount ?></span>
            <?php endif; ?>
        </a>
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-sm font-medium text-white"><?= strtoupper(substr($user->username ?? 'U', 0, 2)) ?></div>
            <div class="hidden sm:block"><p class="text-sm text-white font-medium leading-tight"><?= esc($user->username ?? '') ?></p><p class="text-xs text-gray-500"><?= esc(implode(', ', $user->getGroups() ?? [])) ?></p></div>
        </div>
    </div>
</header>
