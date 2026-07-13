<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'projects', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <form method="get" action="<?= site_url('/dashboard/projects') ?>" class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-search text-sm"></i></span>
                        <input type="text" name="search" placeholder="Search projects..." value="<?= esc($search ?? '') ?>"
                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </form>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="<?= site_url('/dashboard/projects/reorder') ?>" class="flex items-center gap-2 bg-gray-800 text-gray-300 border border-gray-700 px-4 py-2.5 rounded-lg hover:text-white hover:bg-gray-700 transition text-sm"><i class="fas fa-arrows-up-down"></i> Sort</a>
                        <a href="<?= site_url('/dashboard/projects/create') ?>" class="flex items-center gap-2 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm"><i class="fas fa-plus"></i> New Project</a>
                    </div>
                </div>

                <?php $allActive = !$currentStatus ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700'; ?>
                <?php $pubActive = $currentStatus === 'published' ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700'; ?>
                <?php $draftActive = $currentStatus === 'draft' ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700'; ?>
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <a href="<?= site_url('/dashboard/projects') ?>" class="px-3 py-1.5 rounded-lg text-sm font-medium transition <?= $allActive ?>">All</a>
                    <a href="<?= site_url('/dashboard/projects?status=published') ?>" class="px-3 py-1.5 rounded-lg text-sm font-medium transition <?= $pubActive ?>">Published</a>
                    <a href="<?= site_url('/dashboard/projects?status=draft') ?>" class="px-3 py-1.5 rounded-lg text-sm font-medium transition <?= $draftActive ?>">Drafts</a>
                    <span class="text-gray-600 text-sm ml-auto hidden sm:inline"><?= $pager ? $pager->getTotal() . ' total' : '' ?></span>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-700 bg-gray-800/50">
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider w-12">#</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Title</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Status</th>
                                    <th class="text-left px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Date</th>
                                    <th class="text-right px-5 py-3.5 text-gray-400 font-medium text-xs uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <?php foreach ($projects as $project): ?>
                                <tr class="hover:bg-gray-700/50 transition">
                                    <td class="px-5 py-4 text-gray-400"><?= $project->serial ?></td>
                                    <td class="px-5 py-4"><span class="text-white font-medium"><?= esc($project->title) ?></span></td>
                                    <td class="px-5 py-4">
                                        <?php $statusColors = ['published' => 'bg-green-500/10 text-green-400', 'draft' => 'bg-yellow-500/10 text-yellow-400']; ?>
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium <?= $statusColors[$project->status] ?? 'bg-gray-500/10 text-gray-400' ?>"><?= esc(ucfirst($project->status)) ?></span>
                                    </td>
                                    <td class="px-5 py-4 text-gray-400 whitespace-nowrap"><?= date('M j, Y', strtotime($project->created_at)) ?></td>
                                    <td class="px-5 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="<?= site_url('/dashboard/projects/' . $project->id . '/edit') ?>" class="p-1.5 text-gray-500 hover:text-white hover:bg-gray-700 rounded-lg transition" title="Edit"><i class="fas fa-pen text-sm"></i></a>
                                            <form method="post" action="<?= site_url('/dashboard/projects/' . $project->id . '/delete') ?>" onsubmit="return confirm('Are you sure?')" class="inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="p-1.5 text-gray-500 hover:text-red-400 hover:bg-gray-700 rounded-lg transition" title="Delete"><i class="fas fa-trash text-sm"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-700 flex items-center justify-between">
                        <p class="text-sm text-gray-500"><?= $pager ? $pager->getTotal() . ' total' : '' ?></p>
                        <?php if ($pager): ?><?= $pager->links() ?><?php endif; ?>
                    </div>
                </div>
<?= view('admin/layout/footer') ?>
