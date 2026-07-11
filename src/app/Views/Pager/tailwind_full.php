<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);

$total = $pager->getPageCount();

if ($total <= 1) {
    return;
}
?>
<div class="flex items-center gap-1">
    <?php if ($pager->hasPrevious()): ?>
        <a href="<?= $pager->getFirst() ?>" class="px-2 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700" title="First"><i class="fas fa-angle-double-left text-xs"></i></a>
        <a href="<?= $pager->getPrevious() ?>" class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700"><i class="fas fa-chevron-left text-xs"></i></a>
    <?php endif; ?>

    <?php foreach ($pager->links() as $link): ?>
        <?php if ($link['active']): ?>
            <span class="px-3 py-1.5 rounded-lg bg-lime-500 text-gray-900 text-sm font-medium"><?= $link['title'] ?></span>
        <?php else: ?>
            <a href="<?= $link['uri'] ?>" class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700"><?= $link['title'] ?></a>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($pager->hasNext()): ?>
        <a href="<?= $pager->getNext() ?>" class="px-3 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700"><i class="fas fa-chevron-right text-xs"></i></a>
        <a href="<?= $pager->getLast() ?>" class="px-2 py-1.5 rounded-lg bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700 transition text-sm border border-gray-700" title="Last"><i class="fas fa-angle-double-right text-xs"></i></a>
    <?php endif; ?>
</div>
