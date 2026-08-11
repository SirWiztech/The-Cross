<?php
// Shared header: <head>, favicons, sticky nav with live cart pill.
// Pages set $pageTitle and $pageDesc before including this file.

if (!defined('UNIT_PRICE')) {
    require_once __DIR__ . '/../config.php';
}
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/cart-session.php';

$pageTitle = isset($pageTitle) ? $pageTitle : '';
$pageDesc  = isset($pageDesc) ? $pageDesc : 'A handmade paracord cross with a message of redemption. ' . CURRENCY_SYMBOL . UNIT_PRICE . ' per cross, hand-tied with care and prayer.';
$siteTitle = $pageTitle !== '' ? $pageTitle . ' · ' . SITE_TITLE_SUFFIX : SITE_TITLE_SUFFIX;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($siteTitle) ?></title>
  <meta name="description" content="<?= e($pageDesc) ?>">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
  <link rel="manifest" href="assets/site.webmanifest">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,600;9..144,700;9..144,900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body data-unit-price="<?= UNIT_PRICE ?>">

  <header class="site-header" id="top">
    <div class="wrap header-inner">
      <a href="index.php" class="brand" aria-label="<?= e(SITE_NAME) ?> — home">
        <span class="brand-mark">
          <img class="brand-logo" src="assets/img/The Cross Logo.png" alt="<?= e(SITE_NAME) ?> logo">
        </span>
        <span class="brand-text">
          <span class="name"><?= e(SITE_NAME) ?></span>
          <span class="tag"><?= e(SITE_TAGLINE) ?></span>
        </span>
      </a>

      <nav class="main-nav" id="main-nav" aria-label="Main navigation">
        <?php foreach ($navLinks as $link): ?>
          <a href="<?= e($link['href']) ?>" class="<?= is_active($link['file']) ?>">
            <?= render_icon($link['icon'], 'currentColor') ?>
            <span><?= e($link['label']) ?></span>
          </a>
        <?php endforeach; ?>
      </nav>

      <div class="header-cta">
        <a href="cart.php" class="cart-pill" aria-label="View cart">
          <span class="cart-label">Cart:</span>
          <strong id="cart-count"><?= cart_count() ?></strong>
        </a>
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
          <span class="toggle-track">
            <span class="toggle-thumb">
              <svg class="sun-icon" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2"/>
                <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              <svg class="moon-icon" viewBox="0 0 24 24" fill="none">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </span>
        </button>
        <a href="order.php" class="btn btn-primary">Order now</a>
        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="main-nav">
          <span class="bars"><i></i><i></i><i></i></span>
        </button>
      </div>
    </div>
  </header>

  <main>