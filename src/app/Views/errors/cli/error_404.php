ERROR: 404 - Page Not Found
<?php if (ENVIRONMENT !== 'production' && isset($message) && $message !== '') : ?>
  <?= strip_tags($message) ?>
<?php else : ?>
  The page you're looking for doesn't exist or has been moved.
<?php endif; ?>
