<?php
$pageTitle = 'About';
$pageDesc  = 'The story and mission behind Carry the Cross — a ministry sharing the hope of the gospel one hand-tied paracord cross at a time.';
require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Who we are</span>
        <h1>Carry the Cross ministry</h1>
        <p class="lede">A small ministry with a big message: redemption is real, the price was paid, and it is for everyone.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section">
      <div class="wrap">
        <div class="order-grid">
          <div class="reveal">
            <div class="gallery-main" style="padding: clamp(14px, 2.5vw, 26px);">
              <?= render_cross_svg(null, 'about-cross', 300) ?>
            </div>
          </div>

          <div class="stack">
            <?php foreach ($aboutStory as $i => $paragraph): ?>
              <div class="order-panel reveal" style="box-shadow:none;">
                <p style="font-family:var(--font-display); font-weight:600; color:var(--accent); font-size:14px; letter-spacing:0.12em; text-transform:uppercase; margin-bottom:10px;">
                  <?= e(str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT)) ?>
                </p>
                <p style="font-size:16px; line-height:1.7; color:var(--text-secondary);"><?= e($paragraph) ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <?= render_braid_divider(2) ?>

    <section class="section section-alt">
      <div class="wrap">
        <div class="section-head reveal">
          <p class="eyebrow">Our mission</p>
          <h2>Faith, hope &amp; love</h2>
        </div>

        <div class="color-cards">
          <div class="color-card reveal">
            <span class="color-swatch red"><?= render_icon('heart', '#FBF8F2') ?></span>
            <h3>Faith</h3>
            <p>Every cross is tied with prayer, cord over cord, trusting that God waters the smallest seeds He has planted.</p>
          </div>
          <div class="color-card reveal" style="transition-delay:90ms">
            <span class="color-swatch white"><?= render_icon('sparkle', '#A9273B') ?></span>
            <h3>Hope</h3>
            <p>The white strands remind us the stain of sin is gone — scarlet made white as snow. That is our confidence.</p>
          </div>
          <div class="color-card reveal" style="transition-delay:180ms">
            <span class="color-swatch cross"><?= render_icon('cross', '#0f0b0a') ?></span>
            <h3>Love</h3>
            <p>The cross itself is proof: the greatest love ever given, carried on a keychain, a wrist, a bag — anywhere you go.</p>
          </div>
        </div>

        <div class="hero-actions" style="justify-content:center; margin-top:40px;">
          <a href="order.php" class="btn btn-primary">Order your cross</a>
          <a href="contact.php" class="btn btn-outline">Say hello</a>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>