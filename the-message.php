<?php
$pageTitle = 'The Message';
$pageDesc  = 'The meaning behind the colors of the paracord cross — scarlet made white as snow. Most every cord we tie carries a message of redemption.';
require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Why red and white</span>
        <h1>The message behind the colors</h1>
        <p class="lede">Nothing on this cross is just decoration. Each strand carries a piece of the greatest story ever told.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section" style="padding-top:clamp(32px, 5vh, 56px);">
      <div class="wrap">
        <div class="message-grid">
          <div class="quote-card reveal">
            <blockquote>&ldquo;Come now, let us reason together, saith the Lord: though your sins be as scarlet, they shall be as white as snow; though they be red like crimson, they shall be as wool.&rdquo;</blockquote>
            <cite>Isaiah 1:18</cite>
          </div>

          <?php foreach ($messageStory as $i => $story): ?>
            <div class="color-cards">
              <div class="color-card reveal" style="grid-column: 1 / -1; padding: clamp(28px, 4vw, 44px);">
                <h3 style="font-size:22px;"><?= e($story['heading']) ?></h3>
                <p style="line-height:1.7;"><?= e($story['body']) ?></p>
              </div>
            </div>
            <?php if ($i < count($messageStory) - 1): ?>
              <?= render_braid_divider(($i + 1) % 2 + 1) ?>
            <?php endif; ?>
          <?php endforeach; ?>

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
          <a href="about.php" class="btn btn-primary">About this ministry</a>
          <a href="order.php" class="btn btn-outline">Carry your own</a>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>