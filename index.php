<?php
require_once __DIR__ . '/config.php';
$pageTitle = '';
$pageDesc  = 'A handmade paracord cross with a message of redemption. ' . CURRENCY_SYMBOL . '7 per cross, hand-tied with care and prayer.';
require __DIR__ . '/includes/header.php';
?>

    <!-- HERO -->
    <section class="hero" id="top">
      <div class="hero-background"></div>
      <div class="hero-photo"></div>
      <div class="hero-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
      </div>
      <div class="hero-grid-overlay"></div>

      <div class="wrap hero-grid">
        <div class="hero-copy">
          <span class="eyebrow">A ministry of faith, hope &amp; love</span>
          <h1>Carry the cross.<br><span class="line-red">Share the message.</span></h1>
          <p class="hero-sub">A simple cross, hand-tied from paracord, with a powerful message of redemption woven into every strand. Wear it. Share it. Live it.</p>

          <div class="hero-price-row">
            <div class="price-tag">
              <span class="amount">$7</span>
              <span class="per">Per cross<br>+ shipping</span>
            </div>
          </div>

          <div class="hero-actions">
            <a href="order.php" class="btn btn-primary">Order your cross</a>
            <a href="the-message.php" class="btn btn-outline">What it means</a>
          </div>

          <div class="trust-row">
            <span><i></i>Hand-tied to order</span>
            <span><i></i>Ships in days, not weeks</span>
            <span><i></i>Every cross funds the ministry</span>
          </div>
        </div>

        <div class="hero-art">
          <div class="glass">
            <div class="art-inner">
              <img class="hero-logo" src="assets/img/The Cross Logo.png" alt="The Cross — paracord cross logo" width="343" height="420">
            </div>
          </div>
        </div>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <!-- MESSAGE TEASER -->
    <section class="section" id="message">
      <div class="wrap">
        <div class="section-head reveal">
          <p class="eyebrow">Why red and white</p>
          <h2>The message behind the colors</h2>
          <p>Every cord we tie carries meaning. Nothing on this cross is just decoration.</p>
        </div>

        <div class="message-grid">
          <div class="quote-card reveal">
            <blockquote>&ldquo;Though your sins be as scarlet, they shall be as white as snow.&rdquo;</blockquote>
            <cite>Isaiah 1:18</cite>
          </div>

          <div class="color-cards">
            <?php
            $swatchStroke = ['red' => '#FBF8F2', 'white' => '#A9273B', 'cross' => '#0f0b0a'];
            $delay = 0;
            foreach ($colorMeanings as $color):
            ?>
              <div class="color-card reveal" style="transition-delay:<?= $delay ?>ms">
                <span class="color-swatch <?= e($color['id']) ?>">
                  <?= render_icon($color['icon'], $swatchStroke[$color['id']] ?? 'currentColor') ?>
                </span>
                <h3><?= e($color['title']) ?></h3>
                <p><?= e($color['body']) ?></p>
              </div>
            <?php $delay += 90; endforeach; ?>
          </div>
        </div>

        <div class="hero-actions" style="justify-content:center; margin-top:40px;">
          <a href="the-message.php" class="btn btn-primary">Read the full message</a>
        </div>
      </div>
    </section>

    <?= render_braid_divider(2) ?>

    <!-- STATEMENT -->
    <section class="statement" id="about">
      <div class="wrap">
        <span class="statement-mark">
          <?= render_icon('heart', '#FBF8F2') ?>
        </span>
        <p class="reveal">This cross is more than paracord — it's a conversation starter, a testimony, and a way to share the hope we have in Jesus with the world around us.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <!-- FEATURED PRODUCT -->
    <section class="section order-section" id="order">
      <div class="wrap">
        <div class="order-grid">
          <div class="reveal">
            <div class="gallery-main" style="padding: clamp(12px, 2vw, 20px);">
              <?= render_cross_svg($galleryWeaves[0], 'home-featured', 280) ?>
            </div>
          </div>

          <div class="order-panel reveal">
            <p class="eyebrow">The classic carry</p>
            <h2>Hand-tied paracord cross</h2>
            <p class="order-desc">Scarlet and white strands, prayerfully tied around a brass keyring. One cross in your hand, one story ready to share.</p>

            <div class="order-price">
              <span class="amount">$7.00</span>
              <span class="unit">per cross + shipping</span>
            </div>

            <div class="feature-list">
              <?php foreach ($features as $feature): ?>
                <div class="feature-item">
                  <span class="feature-icon"><?= render_icon($feature['icon'], 'var(--accent)') ?></span>
                  <div>
                    <h4><?= e($feature['title']) ?></h4>
                    <p><?= e($feature['body']) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="order-form-actions">
              <a href="order.php" class="btn btn-primary">Order your cross</a>
              <a href="faq.php" class="btn btn-outline">Good to know</a>
            </div>

            <p class="form-note">&#128274; Secure checkout &middot; every order supports the ministry</p>
          </div>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>