</main>

<?php require_once __DIR__ . '/cart-session.php'; ?>
  <!-- FOOTER -->
  <footer class="site-footer" id="contact">
    <div class="wrap footer-grid">
      <div class="footer-brand">
        <a href="index.php" class="brand" aria-label="<?= e(SITE_NAME) ?> — home">
          <span class="brand-mark">
            <img class="brand-logo" src="assets/img/The Cross Logo.png" alt="<?= e(SITE_NAME) ?> logo">
          </span>
          <span class="brand-text">
            <span class="name"><?= e(SITE_NAME) ?></span>
            <span class="tag"><?= e(SITE_TAGLINE) ?></span>
          </span>
        </a>
        <p>A ministry of faith, hope, and love. Thank you for supporting this mission — every cross carries the message a little further.</p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3c-2 0-3.5 1.5-3.5 3.5V11H8v3h2.5v6h3v-6H16l.5-3h-3V9.6c0-.3.2-.6.5-.6Z" stroke="currentColor" stroke-width="1.4"/></svg></a>
          <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="16" height="16" rx="4" stroke="currentColor" stroke-width="1.4"/><circle cx="12" cy="12" r="3.4" stroke="currentColor" stroke-width="1.4"/><circle cx="16.6" cy="7.4" r="1" fill="currentColor"/></svg></a>
          <a href="#" aria-label="TikTok"><svg viewBox="0 0 24 24" fill="none"><path d="M14 4v9.5a2.8 2.8 0 1 1-2.4-2.77M14 4c.3 2 1.7 3.5 3.7 3.7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></a>
        </div>
      </div>

      <div class="footer-col">
        <h5>Explore</h5>
        <a href="the-message.php">The Message</a>
        <a href="about.php">About</a>
        <a href="order.php">Order</a>
        <a href="faq.php">FAQ</a>
      </div>

      <div class="footer-col">
        <h5>Contact</h5>
        <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>
        <a href="order.php">Order your cross</a>
        <a href="cart.php">View your cart</a>
      </div>
    </div>

    <div class="wrap footer-bottom">
      <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?> Ministry. All rights reserved.</span>
      <span>Built with care, one cord at a time.</span>
    </div>
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html>