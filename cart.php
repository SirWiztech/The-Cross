<?php
require __DIR__ . '/includes/cart-session.php';

// Process any POSTed cart action (add / update / remove / clear).
handle_cart_action();

// AJAX requests get a JSON response so the page can update live.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch') {
    header('Content-Type: application/json');
    $quantity = cart_count();
    echo json_encode([
        'ok'        => true,
        'count'     => $quantity,
        'subtotal'  => money(cart_subtotal()),
        'lineTotal' => money($quantity * UNIT_PRICE),
        'redirect'  => cart_has_items() ? null : 'order.php',
    ]);
    exit;
}

// Non-JS fallback: bounce back to the cart after handling an action.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: cart.php');
    exit;
}

$pageTitle = 'Your Cart';
$pageDesc  = 'Review your order of hand-tied paracord crosses before checking out.';
require __DIR__ . '/includes/header.php';
$cartCount = cart_count();
$lineTotal = $cartCount * UNIT_PRICE;
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Almost there</span>
        <h1>Your cart</h1>
        <p class="lede">Everything you've added so far, ready to send on its way.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section">
      <div class="wrap">

        <?php if (!$cartCount): ?>
          <div class="cart-empty glass reveal">
            <?= render_icon('box', 'var(--accent)', 'none') ?>
            <h2>Your cart is empty</h2>
            <p>Pick up a cross — or a handful — and start carrying the message.</p>
            <a href="order.php" class="btn btn-primary">Order your cross</a>
          </div>
        <?php else: ?>

          <div class="cart-list">
            <div class="cart-item reveal">
              <div class="cart-thumb"><?= render_cross_svg(null, 'cart-thumb-svg', 90) ?></div>

              <div class="cart-info">
                <h3>Hand-tied paracord cross</h3>
                <p class="cart-unit"><?= money(UNIT_PRICE) ?> per cross &middot; red &amp; white &middot; brass keyring</p>
              </div>

              <form method="post" action="cart.php" class="cart-qty" data-cart-action="update" aria-label="Update quantity">
                <input type="hidden" name="action" value="update">
                <div class="qty-control">
                  <button type="button" class="qty-btn" aria-label="Decrease quantity">&minus;</button>
                  <input type="number" class="qty-input" name="quantity" value="<?= (int)$cartCount ?>" min="1" max="200" inputmode="numeric" data-qty-for="item-1">
                  <button type="button" class="qty-btn" aria-label="Increase quantity">+</button>
                </div>
              </form>

              <span class="cart-line" data-line-total data-line-for="item-1"><?= money($lineTotal) ?></span>

              <form method="post" action="cart.php" data-cart-action="remove" aria-label="Remove from cart">
                <input type="hidden" name="action" value="remove">
                <button type="submit" class="cart-remove">Remove</button>
              </form>
            </div>
          </div>

          <div class="cart-summary reveal">
            <div>
              <span class="summary-label">Subtotal &middot; <?= (int)$cartCount ?> cross<?= $cartCount !== 1 ? 'es' : '' ?></span><br>
              <span class="summary-total" data-cart-subtotal><?= money($lineTotal) ?></span>
            </div>
            <div class="cart-actions" style="margin-top:0;">
              <form method="post" action="cart.php" data-cart-action="clear">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="btn btn-outline">Clear cart</button>
              </form>
              <a href="checkout.php" class="btn btn-primary">Proceed to checkout</a>
            </div>
          </div>

          <p class="form-note" style="margin-top:20px;">Shipping is calculated at checkout. No payment is taken online — we confirm by email.</p>

        <?php endif; ?>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>