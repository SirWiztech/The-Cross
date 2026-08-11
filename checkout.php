<?php
require __DIR__ . '/includes/cart-session.php';

$errors = [];
$old = [
    'name'     => '',
    'email'    => '',
    'address'  => '',
    'city'     => '',
    'region'   => '',
    'zip'      => '',
    'country'  => '',
    'note'     => '',
];

// Guard: nothing to check out — send them to the cart.
if (!cart_has_items() && !isset($_SESSION['last_order'])) {
    $emptyCart = true;
} else {
    $emptyCart = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && cart_has_items()) {
    $old = [
        'name'    => trim((string)($_POST['name'] ?? '')),
        'email'   => trim((string)($_POST['email'] ?? '')),
        'address' => trim((string)($_POST['address'] ?? '')),
        'city'    => trim((string)($_POST['city'] ?? '')),
        'region'  => trim((string)($_POST['region'] ?? '')),
        'zip'     => trim((string)($_POST['zip'] ?? '')),
        'country' => trim((string)($_POST['country'] ?? '')),
        'note'    => trim((string)($_POST['note'] ?? '')),
    ];

    if ($old['name'] === '')          $errors['name'] = 'Please tell us your name.';
    if ($old['email'] === '')         $errors['email'] = 'Please add your email address.';
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'That email address doesn\'t look valid.';
    if ($old['address'] === '')       $errors['address'] = 'Please add your street address.';
    if ($old['city'] === '')          $errors['city'] = 'Please add your city.';
    if ($old['zip'] === '')           $errors['zip'] = 'Please add your ZIP / postal code.';
    if ($old['country'] === '')       $errors['country'] = 'Please add your country.';

    if (empty($errors)) {
        $ref = ORDER_PREFIX . strtoupper(base_convert(bin2hex(random_bytes(4)), 16, 36));
        $_SESSION['last_order'] = [
            'ref'      => $ref,
            'name'     => $old['name'],
            'email'    => $old['email'],
            'address'  => $old['address'] . ', ' . $old['city'] . ($old['region'] !== '' ? ', ' . $old['region'] : '') . ' ' . $old['zip'] . ', ' . $old['country'],
            'count'    => cart_count(),
            'subtotal' => cart_subtotal(),
            'note'     => $old['note'],
        ];
        cart_remove();
        header('Location: order-confirmation.php?ref=' . urlencode($ref));
        exit;
    }
}

$pageTitle = 'Checkout';
$pageDesc  = 'Confirm your shipping details for your order of hand-tied paracord crosses.';
require __DIR__ . '/includes/header.php';

$cartCount  = cart_count();
$subtotal   = cart_subtotal();
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Last step</span>
        <h1>Checkout</h1>
        <p class="lede">Share where your crosses should go. We confirm every order by email — no online payment needed.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section">
      <div class="wrap">

        <?php if ($emptyCart): ?>
          <div class="cart-empty glass reveal">
            <?= render_icon('box', 'var(--accent)', 'none') ?>
            <h2>Nothing to check out</h2>
            <p>Add a cross to your cart first, then come right back.</p>
            <a href="order.php" class="btn btn-primary">Order your cross</a>
          </div>

        <?php else: ?>

          <div class="grid-2">
            <div class="order-panel reveal">
              <p class="eyebrow">Shipping details</p>
              <h2 style="font-family:var(--font-display); font-size:clamp(24px,3vw,30px); margin:6px 0 18px;">Where should we send it?</h2>

              <?php if (!empty($errors)): ?>
                <div class="form-summary">Please fix the fields highlighted below and try again.</div>
              <?php endif; ?>

              <form method="post" action="checkout.php" novalidate>
                <div class="form-field<?= isset($errors['name']) ? ' has-error' : '' ?>">
                  <label for="name">Full name</label>
                  <input type="text" id="name" name="name" value="<?= e($old['name']) ?>" autocomplete="name" required>
                  <?php if (isset($errors['name'])): ?><span class="field-error" role="alert"><?= e($errors['name']) ?></span><?php endif; ?>
                </div>

                <div class="form-field<?= isset($errors['email']) ? ' has-error' : '' ?>">
                  <label for="email">Email address</label>
                  <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" autocomplete="email" required>
                  <?php if (isset($errors['email'])): ?><span class="field-error" role="alert"><?= e($errors['email']) ?></span><?php endif; ?>
                </div>

                <div class="form-field<?= isset($errors['address']) ? ' has-error' : '' ?>">
                  <label for="address">Street address</label>
                  <input type="text" id="address" name="address" value="<?= e($old['address']) ?>" autocomplete="street-address" required>
                  <?php if (isset($errors['address'])): ?><span class="field-error" role="alert"><?= e($errors['address']) ?></span><?php endif; ?>
                </div>

                <div class="form-row">
                  <div class="form-field<?= isset($errors['city']) ? ' has-error' : '' ?>">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?= e($old['city']) ?>" autocomplete="address-level2" required>
                    <?php if (isset($errors['city'])): ?><span class="field-error" role="alert"><?= e($errors['city']) ?></span><?php endif; ?>
                  </div>
                  <div class="form-field">
                    <label for="region">State / Region <span style="text-transform:none;">(optional)</span></label>
                    <input type="text" id="region" name="region" value="<?= e($old['region']) ?>" autocomplete="address-level1">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-field<?= isset($errors['zip']) ? ' has-error' : '' ?>">
                    <label for="zip">ZIP / Postal code</label>
                    <input type="text" id="zip" name="zip" value="<?= e($old['zip']) ?>" autocomplete="postal-code" required>
                    <?php if (isset($errors['zip'])): ?><span class="field-error" role="alert"><?= e($errors['zip']) ?></span><?php endif; ?>
                  </div>
                  <div class="form-field<?= isset($errors['country']) ? ' has-error' : '' ?>">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" value="<?= e($old['country']) ?>" autocomplete="country-name" required>
                    <?php if (isset($errors['country'])): ?><span class="field-error" role="alert"><?= e($errors['country']) ?></span><?php endif; ?>
                  </div>
                </div>

                <div class="form-field">
                  <label for="note">Note <span style="text-transform:none;">(optional)</span></label>
                  <textarea id="note" name="note"><?= e($old['note']) ?></textarea>
                </div>

                <div class="order-form-actions">
                  <button type="submit" class="btn btn-primary">Place order</button>
                  <a href="cart.php" class="btn btn-outline">Back to cart</a>
                </div>
              </form>
            </div>

            <div class="stack">
              <div class="summary-panel reveal">
                <h3>Order summary</h3>
                <div class="summary-row">
                  <span><?= (int)$cartCount ?> cross<?= $cartCount !== 1 ? 'es' : '' ?> &times; <?= money(UNIT_PRICE) ?></span>
                  <span><?= money($subtotal) ?></span>
                </div>
                <div class="summary-row">
                  <span>Shipping</span>
                  <span>Calculated by email</span>
                </div>
                <div class="summary-row total">
                  <span>Subtotal</span>
                  <span><?= money($subtotal) ?></span>
                </div>
                <div class="order-note">
                  We'll confirm your order and shipping cost by email before anything is final. You're never charged until you say yes.
                </div>
              </div>

              <div class="order-panel reveal">
                <h3 style="font-family:var(--font-display); font-size:20px; margin-bottom:12px;">Order by email instead</h3>
                <p style="font-size:15px; color:var(--text-secondary); line-height:1.7;">
                  Prefer not to use the form? Email your order and we'll handle it personally.
                </p>
                <a href="mailto:<?= e(CONTACT_EMAIL) ?>?subject=<?= rawurlencode('Cross order enquiry') ?>" class="btn btn-outline" style="margin-top:14px;"><?= e(CONTACT_EMAIL) ?></a>
              </div>
            </div>
          </div>

        <?php endif; ?>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>