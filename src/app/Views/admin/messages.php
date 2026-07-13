<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'messages', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')): ?>
                    <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
                <?php endif; ?>

                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <a href="/dashboard/messages" class="px-3 py-1.5 rounded-lg text-sm font-medium <?= $isRead === null ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700' ?>">All</a>
                    <a href="/dashboard/messages?status=unread" class="px-3 py-1.5 rounded-lg text-sm font-medium <?= $isRead === 'unread' ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700' ?>">Unread</a>
                    <a href="/dashboard/messages?status=read" class="px-3 py-1.5 rounded-lg text-sm font-medium <?= $isRead === 'read' ? 'bg-lime-500 text-gray-900' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 border border-gray-700' ?>">Read</a>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="divide-y divide-gray-700">
                        <?php if (empty($messages)): ?>
                        <div class="p-8 text-center text-gray-500 text-sm">No messages found.</div>
                        <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                        <div class="p-5 hover:bg-gray-700/30 transition <?= !$msg->is_read ? 'border-l-2 border-lime-500' : '' ?>">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-lime-500/20 rounded-full flex items-center justify-center text-sm font-medium text-lime-400"><?= strtoupper(substr($msg->name, 0, 2)) ?></div>
                                    <div>
                                        <p class="text-sm text-white font-medium"><?= esc($msg->name) ?></p>
                                        <p class="text-xs text-gray-500"><?= esc($msg->email) ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <?php if (!$msg->is_read): ?>
                                    <span class="px-2 py-0.5 rounded text-xs bg-lime-500/10 text-lime-400">Unread</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="text-sm text-gray-300 mb-1"><span class="text-gray-500">Subject:</span> <?= esc($msg->subject) ?></p>
                            <p class="text-sm text-gray-400 mb-3 line-clamp-2"><?= esc(mb_substr($msg->message, 0, 150)) ?><?= mb_strlen($msg->message) > 150 ? '...' : '' ?></p>
                            <div class="flex items-center justify-between border-t border-gray-700/50 pt-2">
                                <span class="text-xs text-gray-600"><i class="far fa-clock mr-1"></i><?= time_elapsed_string($msg->created_at) ?></span>
                                <div class="flex items-center gap-2">
                                    <a href="<?= site_url('/dashboard/messages/' . $msg->id . '/edit') ?>" class="px-2 py-1 text-xs bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500/20 transition"><i class="fas fa-eye mr-1"></i>View</a>
                                    <form method="post" action="<?= site_url('/dashboard/messages/' . $msg->id . '/delete') ?>" onsubmit="return confirm('Delete this message?')" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="px-2 py-1 text-xs bg-red-500/10 text-red-400 rounded hover:bg-red-500/20 transition"><i class="fas fa-trash mr-1"></i>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($pager): ?>
                    <div class="px-5 py-3 border-t border-gray-700">
                        <?= $pager->links() ?>
                    </div>
                    <?php endif; ?>
                </div>
<?= view('admin/layout/footer') ?>
