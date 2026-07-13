<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'messages', 'unreadCount' => $unreadCount, 'user' => $user]) ?>
                <?php if (session('message')): ?>
                    <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
                <?php endif; ?>

                <div class="flex items-center justify-between mb-6">
                    <a href="/dashboard/messages" class="text-sm text-gray-400 hover:text-white transition"><i class="fas fa-arrow-left mr-1"></i>Back to Messages</a>
                    <form method="post" action="<?= site_url('/dashboard/messages/' . $message->id . '/delete') ?>" onsubmit="return confirm('Delete this message?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-3 py-1.5 text-xs bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition"><i class="fas fa-trash mr-1"></i>Delete</button>
                    </form>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 max-w-3xl">
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-700">
                        <div class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center text-lg font-medium text-lime-400"><?= strtoupper(substr($message->name, 0, 2)) ?></div>
                        <div>
                            <h2 class="text-white font-semibold text-lg"><?= esc($message->name) ?></h2>
                            <a href="mailto:<?= esc($message->email) ?>" class="text-sm text-lime-400 hover:text-lime-300 transition"><?= esc($message->email) ?></a>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Subject</label>
                            <p class="text-white text-sm"><?= esc($message->subject) ?></p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Received</label>
                            <p class="text-gray-400 text-sm"><?= date('M j, Y \a\t g:i A', strtotime($message->created_at)) ?></p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Message</label>
                            <div class="bg-gray-900 rounded-lg p-4 text-sm text-gray-300 whitespace-pre-wrap leading-relaxed"><?= esc($message->message) ?></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                        <form method="post" action="<?= site_url('/dashboard/messages/' . $message->id) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="is_read" value="<?= $message->is_read ? '0' : '1' ?>">
                            <button type="submit" class="px-3 py-1.5 text-xs rounded-lg transition <?= $message->is_read ? 'bg-yellow-500/10 text-yellow-400 hover:bg-yellow-500/20' : 'bg-gray-500/10 text-gray-400 hover:bg-gray-500/20' ?>">
                                <i class="fas fa-<?= $message->is_read ? 'envelope' : 'envelope-open' ?> mr-1"></i><?= $message->is_read ? 'Mark as Unread' : 'Mark as Read' ?>
                            </button>
                        </form>
                        <a href="mailto:<?= esc($message->email) ?>?subject=Re: <?= urlencode($message->subject) ?>" class="px-3 py-1.5 text-xs bg-lime-500/10 text-lime-400 rounded-lg hover:bg-lime-500/20 transition"><i class="fas fa-reply mr-1"></i>Reply via Email</a>
                    </div>
                </div>
<?= view('admin/layout/footer') ?>
