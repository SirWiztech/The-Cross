<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Order';
$pageDesc  = 'Order your hand-tied paracord cross. ' . CURRENCY_SYMBOL . '7 per cross plus shipping, made to give away with the gospel message.';
require __DIR__ . '/includes/cart-session.php';
require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero" style="padding-bottom:0;">
      <div class="wrap">
        <span class="eyebrow">Order your cross</span>
        <h1>Every cross is tied with care and prayer</h1>
        <p class="lede">Choose a quantity — many people order a handful to keep giving away. Shipping is calculated once at checkout.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section order-section" style="padding-top:clamp(36px, 5vh, 56px);">
      <div class="wrap">
        <div class="order-grid">

          <!-- gallery -->
          <div class="reveal">
            <div class="gallery-main" id="gallery-main">
              <?= render_cross_svg($galleryWeaves[0], 'gallery', 280) ?>
            </div>
            <div class="gallery-thumbs">
              <?php foreach ($galleryWeaves as $i => $weave): ?>
                <button type="button" class="gallery-thumb<?= $i === 0 ? ' active' : '' ?>" data-weave="<?= e($weave['id']) ?>" aria-label="<?= e($weave['label']) ?>">
                  <?= render_cross_svg($weave, 'thumb' . $i, 90) ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- order panel -->
          <div class="order-panel reveal">
            <p class="eyebrow">Hand-tied paracord cross</p>
            <h2>Red &amp; white, around a brass keyring</h2>
            <p class="order-desc">The classic carry — scarlet and white strands prayerfully tied together, ready to wear or to give away.</p>

            <div class="order-price">
              <span class="amount">$7.00</span>
              <span class="unit">per cross + shipping</span>
            </div>

            <div class="order-alert success" id="orderFeedback" style="display:none;"></div>

            <form method="post" action="cart.php" id="order-form">
              <input type="hidden" name="action" value="add">

              <div class="qty-row">
                <label for="quantity">Quantity</label>
                <div class="qty-control">
                  <button type="button" id="qty-dec" aria-label="Decrease quantity">&minus;</button>
                  <input type="number" id="quantity" name="quantity" value="1" min="1" max="200" inputmode="numeric">
                  <button type="button" id="qty-inc" aria-label="Increase quantity">+</button>
                </div>
              </div>

              <div class="order-total">
                <span>Subtotal</span>
                <strong>$<span id="order-total-amount">7.00</span></strong>
              </div>

              <div class="order-form-actions">
                <button type="submit" class="btn btn-primary">Add to cart</button>
                <a href="contact.php" class="btn btn-outline">Order by email instead</a>
              </div>

              <p class="form-note">&#128274; Secure checkout &middot; every order supports the ministry</p>
            </form>

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
          </div>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>