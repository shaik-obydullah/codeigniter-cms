<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'activities', 'unreadCount' => $unreadCount, 'user' => $user]) ?>

                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <button class="px-3 py-1.5 rounded-lg bg-lime-500 text-gray-900 text-sm font-medium">All</button>
                    <input type="text" placeholder="Search activities..." class="ml-auto bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500 w-64" />
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="divide-y divide-gray-700">
                        <?php if (!empty($activities)): ?>
                            <?php foreach ($activities as $activity): ?>
                            <div class="p-4 flex items-start gap-4 hover:bg-gray-700/30 transition">
                                <div class="w-9 h-9 bg-lime-500/20 rounded-full flex items-center justify-center text-sm font-medium text-lime-400 shrink-0">
                                    <?= strtoupper(substr($activity->user_id ? ('User#' . $activity->user_id) : 'SY', 0, 2)) ?>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-baseline justify-between gap-4">
                                        <p class="text-sm text-white"><?= esc($activity->description) ?></p>
                                        <span class="text-xs text-gray-600 shrink-0 whitespace-nowrap"><?= time_elapsed_string($activity->created_at) ?></span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5"><?= esc($activity->target_type ?? '') ?> <?= $activity->target_id ? '#' . $activity->target_id : '' ?></p>
                                </div>
                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-lime-500/10 text-lime-400 shrink-0"><?= esc($activity->type) ?></span>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="px-5 py-12 text-center text-gray-500 text-sm">No activities recorded yet.</div>
                        <?php endif; ?>
                    </div>

                    <?php if ($pager): ?>
                    <div class="px-5 py-3 border-t border-gray-700 flex items-center justify-between">
                        <p class="text-sm text-gray-500"><?= $pager->getTotal() ?> total</p>
                        <?= $pager->links() ?>
                    </div>
                    <?php endif; ?>
                </div>
<?= view('admin/layout/footer') ?>
