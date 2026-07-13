<?= view('admin/layout/header', ['pageTitle' => $pageTitle, 'currentPage' => 'skills', 'unreadCount' => $unreadCount, 'user' => $user, 'extraHead' => '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>']) ?>
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-white">Drag to reorder skills</h2>
                        <p class="text-sm text-gray-400 mt-1">Drag and drop items to change their display order. Serial numbers update automatically.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?= site_url('/dashboard/skills') ?>" class="flex items-center gap-2 bg-gray-800 text-gray-300 border border-gray-700 px-4 py-2.5 rounded-lg hover:text-white hover:bg-gray-700 transition text-sm">
                            <i class="fas fa-arrow-left"></i> Back to Skills
                        </a>
                        <button id="saveBtn" disabled class="flex items-center gap-2 bg-lime-500 text-gray-900 font-semibold px-4 py-2.5 rounded-lg hover:bg-lime-400 transition text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                            <i class="fas fa-save"></i> Save Order
                        </button>
                    </div>
                </div>

                <div id="toast" class="hidden fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-sm font-medium shadow-lg"></div>

                <div id="skillList" class="space-y-2 max-w-3xl">
                    <?php foreach ($skills as $skill): ?>
                    <div class="skill-item flex items-center gap-4 bg-gray-800 border border-gray-700 rounded-xl px-5 py-4 cursor-grab active:cursor-grabbing hover:border-gray-600 transition" data-id="<?= $skill->id ?>">
                        <div class="drag-handle text-gray-600 hover:text-gray-400 transition">
                            <i class="fas fa-grip-vertical text-lg"></i>
                        </div>
                        <div class="serial-badge flex items-center justify-center w-8 h-8 rounded-lg bg-gray-700 text-gray-300 text-sm font-bold shrink-0">
                            <?= $skill->serial ?>
                        </div>
                        <div class="w-10 h-10 bg-lime-500/10 rounded-lg flex items-center justify-center text-lg text-lime-400 shrink-0">
                            <i class="<?= esc($skill->icon ?? 'fas fa-code') ?>"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-medium truncate"><?= esc($skill->name) ?></p>
                            <?php if (!empty($skill->description)): ?>
                            <p class="text-xs text-gray-400 mt-0.5 truncate"><?= esc($skill->description) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if (empty($skills)): ?>
                <div class="text-center py-16 text-gray-500">
                    <i class="fas fa-code text-4xl mb-3"></i>
                    <p>No skills found.</p>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const list = document.getElementById('skillList');
        const saveBtn = document.getElementById('saveBtn');
        const toast = document.getElementById('toast');
        let hasChanges = false;

        const sortable = new Sortable(list, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'opacity-40',
            chosenClass: 'border-lime-500',
            onEnd: function () {
                hasChanges = true;
                saveBtn.disabled = false;
                updateSerials();
            }
        });

        function updateSerials() {
            const items = list.querySelectorAll('.skill-item');
            items.forEach(function (item, index) {
                item.querySelector('.serial-badge').textContent = index + 1;
            });
        }

        function showToast(message, type) {
            toast.textContent = message;
            toast.className = 'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-sm font-medium shadow-lg ' +
                (type === 'success' ? 'bg-green-500/15 text-green-400 border border-green-500/30' : 'bg-red-500/15 text-red-400 border border-red-500/30');
            setTimeout(function () { toast.className = 'hidden fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-sm font-medium shadow-lg'; }, 3000);
        }

        saveBtn.addEventListener('click', function () {
            const items = list.querySelectorAll('.skill-item');
            const orders = [];
            items.forEach(function (item, index) {
                orders.push({ id: parseInt(item.dataset.id), serial: index + 1 });
            });

            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

            fetch('<?= site_url('/dashboard/skills/reorder') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify(orders)
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.success) {
                    hasChanges = false;
                    showToast('Order saved successfully.', 'success');
                } else {
                    showToast(data.message || 'Failed to save order.', 'error');
                    saveBtn.disabled = false;
                }
                saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Order';
            })
            .catch(function () {
                showToast('Network error. Please try again.', 'error');
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Order';
            });
        });

        window.addEventListener('beforeunload', function (e) {
            if (hasChanges) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    });
    </script>
<?= view('admin/layout/footer') ?>