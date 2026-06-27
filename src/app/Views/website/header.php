<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="Content-Language" content="en" />
  <meta name="robots" content="index, follow" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#000000" media="(prefers-color-scheme: dark)">
  <meta name="msapplication-config" content="/assets/images/favicon/browserconfig.xml">

  <title><?= htmlspecialchars($settings['meta_title'] ?? '', ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description"
    content="<?= htmlspecialchars($settings['meta_description'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($settings['meta_keywords'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <meta name="author" content="<?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="copyright" content="<?= htmlspecialchars($settings['meta_copyright'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <meta property="og:locale" content="en_US" />
  <meta property="og:title" content="<?= htmlspecialchars($settings['meta_title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta property="og:description"
    content="<?= htmlspecialchars($settings['meta_description'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= htmlspecialchars($settings['meta_url'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <meta property="og:image" content="<?= htmlspecialchars($settings['meta_image'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta property="og:site_name"
    content="<?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($settings['meta_title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="twitter:description"
    content="<?= htmlspecialchars($settings['meta_description'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars($settings['meta_image'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="twitter:image:alt"
    content="<?= htmlspecialchars($settings['project_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="512x512" href="/assets/images/favicon/android-chrome-512x512.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/favicon/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
  <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico">

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <link rel="canonical" href="<?= htmlspecialchars($settings['meta_url'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />

  <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Shaik Obydullah",
        "image": "<?= htmlspecialchars($settings['meta_image'], ENT_QUOTES, 'UTF-8') ?>",
        "jobTitle": "<?= htmlspecialchars($settings['meta_title'], ENT_QUOTES, 'UTF-8') ?>",
        "url": "<?= htmlspecialchars($settings['meta_url'], ENT_QUOTES, 'UTF-8') ?>",
        "sameAs": [
            <?php if (!empty($settings['linkedin'])): ?> "<?= htmlspecialchars($settings['linkedin'], ENT_QUOTES, 'UTF-8') ?>",
            <?php endif; ?>
            <?php if (!empty($settings['github'])): ?> "<?= htmlspecialchars($settings['github'], ENT_QUOTES, 'UTF-8') ?>"
            <?php endif; ?>
        ],
        "description": "<?= htmlspecialchars($settings['meta_description'], ENT_QUOTES, 'UTF-8') ?>",
        "skills": [
            "PHP", "Laravel", "React.js", "Next.js",
            "AWS", "MySQL", "PostgreSQL",
            "Systems Analysis", "Cloud Architecture"
        ]
    }
    </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/animations.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github-dark.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/style.css">

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
  <!-- Google Analytics (loaded only on consent) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8M2VZRNJV"></script>

  <!-- CookieConsent CSS (optional CDN, enhances style) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

  <!-- CookieConsent Script -->
  <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
  <script>
    window.addEventListener("load", function () {
      window.cookieconsent.initialise({
        palette: {
          popup: {
            background: "#1f2937", // dark gray
            text: "#ffffff"
          },
          button: {
            background: "#10b981", // lime/emerald green
            text: "#ffffff"
          }
        },
        theme: "classic",
        position: "bottom-right",
        type: "opt-in",
        content: {
          message: "We use cookies to improve your experience. By accepting, you agree to our use of cookies.",
          allow: "Accept",
          deny: "Decline",
          link: "Privacy Policy",
          href: "/privacy-policy"
        },
        elements: {
          messagelink: '<span id="cookieconsent:desc" class="cc-message">{{message}} <a aria-label="learn more about cookies" tabindex="0" class="cc-link" href="{{href}}" target="_blank">{{link}}</a></span>',
          dismiss: '<a aria-label="dismiss cookie message" role=button tabindex="0" class="cc-btn cc-dismiss">{{dismiss}}</a>',
          allow: '<a aria-label="allow cookies" role=button tabindex="0" class="cc-btn cc-allow">{{allow}}</a>',
          deny: '<a aria-label="deny cookies" role=button tabindex="0" class="cc-btn cc-deny">{{deny}}</a>'
        },
        onInitialise: function (status) {
          if (status === 'allow') {
            // Load GA tracking code only after consent
            window.dataLayer = window.dataLayer || [];

            function gtag() {
              dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-Q8M2VZRNJV');
          }
        }
      });
    });
  </script>
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>