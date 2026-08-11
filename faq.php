<?php
$pageTitle = 'FAQ';
$pageDesc  = 'Quick answers about shipping, bulk orders, materials, care, and where the money goes for the paracord cross ministry.';
require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Good to know</span>
        <h1>A few quick answers</h1>
        <p class="lede">Everything you might wonder before you carry a cross. Tap a question to open its answer.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section" style="padding-top:clamp(36px, 5vh, 56px);">
      <div class="wrap">
        <div class="faq-list">
          <?php foreach ($faqItems as $i => $faq): ?>
            <div class="faq-item reveal">
              <button type="button" class="faq-toggle" aria-expanded="true" aria-controls="faq-panel-<?= $i ?>" id="faq-toggle-<?= $i ?>">
                <span><?= e($faq['q']) ?></span>
                <span class="faq-icon" aria-hidden="true">+</span>
              </button>
              <div class="faq-panel" id="faq-panel-<?= $i ?>" role="region" aria-labelledby="faq-toggle-<?= $i ?>">
                <div class="faq-answer"><?= e($faq['a']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="order-panel reveal center" style="max-width:520px; margin:36px auto 0;">
          <h3 style="font-family:var(--font-display); font-size:22px; margin-bottom:8px;">Still curious?</h3>
          <p style="color:var(--text-secondary); font-size:15px; margin-bottom:20px;">Email us any time. We'd love to talk.</p>
          <a href="contact.php" class="btn btn-primary">Ask us a question</a>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>