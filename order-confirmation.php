<?php
require __DIR__ . '/includes/cart-session.php';

// Only the most recently placed order may view this page (via ?ref=).
$ref = isset($_GET['ref']) ? trim((string)$_GET['ref']) : '';
$order = null;
if ($ref !== '' && isset($_SESSION['last_order']) && $_SESSION['last_order']['ref'] === $ref) {
    $order = $_SESSION['last_order'];
}

$pageTitle = 'Order Confirmation';
$pageDesc  = 'Thank you for your order of hand-tied paracord crosses. God bless you.';
require __DIR__ . '/includes/header.php';
?>

    <section class="section">
      <div class="wrap">
        <?php if (!$order): ?>
          <div class="cart-empty glass reveal">
            <?= render_icon('box', 'var(--accent)', 'none') ?>
            <h2>No recent order found</h2>
            <p>If you just placed an order, make sure you arrived here straight from checkout.</p>
            <a href="order.php" class="btn btn-primary">Start a new order</a>
          </div>
        <?php else: ?>

          <div class="summary-panel confirm-card reveal">
            <div class="confirm-mark">
              <?= render_icon('check', '#fff') ?>
            </div>

            <h1 style="font-family:var(--font-display); font-size:clamp(30px,4vw,42px); font-weight:900; color:var(--text-primary);">Thank you, <?= e($order['name']) ?>!</h1>
            <p style="color:var(--text-secondary); font-size:16px; max-width:46ch; margin:14px auto 0;">
              Your order is being prepared. We'll email a confirmation to
              <strong><?= e($order['email']) ?></strong> with the final shipping cost — no payment is taken online.
            </p>

            <div class="confirm-order-rows">
              <div class="summary-row">
                <span>Order reference</span>
                <span style="font-family:var(--font-display); font-weight:700; color:var(--accent);"><?= e($order['ref']) ?></span>
              </div>
              <div class="summary-row">
                <span><?= (int)$order['count'] ?> cross<?= $order['count'] !== 1 ? 'es' : '' ?> &middot; <?= money(UNIT_PRICE) ?> each</span>
                <span><?= money($order['subtotal']) ?></span>
              </div>
              <div class="summary-row">
                <span>Shipping to</span>
                <span><?= e($order['address']) ?></span>
              </div>
              <?php if ($order['note'] !== ''): ?>
                <div class="summary-row">
                  <span>Your note</span>
                  <span><?= e($order['note']) ?></span>
                </div>
              <?php endif; ?>
              <div class="summary-row total">
                <span>Subtotal</span>
                <span><?= money($order['subtotal']) ?></span>
              </div>
            </div>

            <div class="hero-actions" style="justify-content:center; margin-top:28px;">
              <a href="the-message.php" class="btn btn-primary">Read the message</a>
              <a href="about.php" class="btn btn-outline">About the ministry</a>
            </div>
          </div>

        <?php endif; ?>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>