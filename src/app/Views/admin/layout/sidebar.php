<aside class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gray-800 border-r border-gray-700 flex flex-col shrink-0 -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">
    <div class="p-5 border-b border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-lime-500 rounded-lg flex items-center justify-center"><i class="fas fa-shield-halved text-sm text-gray-900"></i></div>
            <div><h1 class="text-white font-bold text-sm">AdminPanel</h1><p class="text-gray-500 text-xs">v1.0.0</p></div>
        </div>
    </div>
    <nav class="flex-1 overflow-y-auto p-3 space-y-1">
        <a href="<?= site_url('/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'dashboard' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-chart-pie w-5 text-center"></i><span>Dashboard</span></a>
        <a href="<?= site_url('/dashboard/articles') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'articles' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-newspaper w-5 text-center"></i><span>Articles</span></a>
        <a href="<?= site_url('/dashboard/projects') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'projects' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-diagram-project w-5 text-center"></i><span>Projects</span></a>
        <a href="<?= site_url('/dashboard/users') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'users' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-users w-5 text-center"></i><span>Users</span></a>
        <a href="<?= site_url('/dashboard/categories') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'categories' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-folder w-5 text-center"></i><span>Categories</span></a>
        <a href="<?= site_url('/dashboard/tags') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'tags' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-tags w-5 text-center"></i><span>Tags</span></a>
        <a href="<?= site_url('/dashboard/comments') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'comments' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-comments w-5 text-center"></i><span>Comments</span></a>
        <a href="<?= site_url('/dashboard/media') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'media' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-photo-film w-5 text-center"></i><span>Media</span></a>
        <div class="pt-4 pb-2"><p class="px-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Settings</p></div>
        <a href="<?= site_url('/dashboard/site-settings') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'site-settings' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-gear w-5 text-center"></i><span>Site Settings</span></a>
        <a href="<?= site_url('/dashboard/roles') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'roles' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-shield w-5 text-center"></i><span>Roles & Permissions</span></a>
        <a href="<?= site_url('/dashboard/activities') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'activities' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-clock-rotate-left w-5 text-center"></i><span>Activities</span></a>
        <a href="<?= site_url('/dashboard/notifications') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'notifications' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-bell w-5 text-center"></i><span>Notifications</span></a>
        <a href="<?= site_url('/dashboard/skills') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'skills' ? 'bg-lime-500 text-gray-900 font-medium' : 'text-gray-400 hover:text-white hover:bg-gray-700' ?> transition text-sm"><i class="fas fa-code w-5 text-center"></i><span>Skills</span></a>
    </nav>
    <div class="p-3 border-t border-gray-700">
        <a href="<?= site_url('/logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-400 hover:text-red-400 hover:bg-gray-700 transition text-sm"><i class="fas fa-right-from-bracket w-5 text-center"></i><span>Logout</span></a>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.querySelector('.sidebar-toggle');
    var sidebar = document.querySelector('aside');
    if (toggle && sidebar) {
        toggle.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('lg:-translate-x-0');
        });
    }
});
</script>
