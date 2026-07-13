<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'notifications', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>

                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 rounded-lg bg-lime-500 text-gray-900 text-sm font-medium">All</button>
                        <button class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700">Unread (<?= $unreadCount ?>)</button>
                    </div>
                    <form method="post" action="<?= site_url('/dashboard/notifications/read-all') ?>">
                        <?= csrf_field() ?>
                        <button type="submit" class="text-sm text-gray-400 hover:text-white transition"><i class="fas fa-check-double mr-1.5"></i>Mark All as Read</button>
                    </form>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden divide-y divide-gray-700">
                    <?php if (!empty($notifications)): ?>
                        <?php foreach ($notifications as $notification): ?>
                        <div class="px-5 py-4 flex items-start gap-4 hover:bg-gray-700/30 transition relative <?= !$notification->is_read ? 'bg-lime-500/5' : '' ?>">
                            <?php if (!$notification->is_read): ?><span class="w-2 h-2 bg-lime-500 rounded-full mt-2 shrink-0"></span><?php endif; ?>
                            <div class="w-9 h-9 bg-blue-500/20 rounded-full flex items-center justify-center text-blue-400 shrink-0"><i class="fas fa-<?= esc($notification->type === 'user.created' ? 'user-plus' : ($notification->type === 'comment' ? 'comment' : 'bell')) ?> text-xs"></i></div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-baseline justify-between gap-4">
                                    <p class="text-sm text-white font-medium"><?= esc($notification->title) ?></p>
                                    <span class="text-xs text-gray-600 shrink-0 whitespace-nowrap"><?= time_elapsed_string($notification->created_at) ?></span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5"><?= esc($notification->message) ?></p>
                            </div>
                            <?php if (!$notification->is_read): ?>
                            <form method="post" action="<?= site_url('/dashboard/notifications/' . $notification->id . '/read') ?>">
                                <?= csrf_field() ?>
                                <button type="submit" class="text-gray-600 hover:text-white transition shrink-0" title="Mark Read"><i class="fas fa-check text-xs"></i></button>
                            </form>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-5 py-12 text-center text-gray-500 text-sm">No notifications yet.</div>
                    <?php endif; ?>
                </div>

                <?php if ($pager): ?>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-sm text-gray-500"><?= $pager->getTotal() ?> total</p>
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>
<?= view('admin/layout/footer') ?>
