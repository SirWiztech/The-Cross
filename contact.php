<?php
require __DIR__ . '/includes/cart-session.php';

$errors = [];
$old = ['name' => '', 'email' => '', 'message' => ''];
$formSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = [
        'name'    => trim((string)($_POST['name'] ?? '')),
        'email'   => trim((string)($_POST['email'] ?? '')),
        'message' => trim((string)($_POST['message'] ?? '')),
    ];
    $website = trim((string)($_POST['website'] ?? '')); // honeypot

    if ($website !== '') {
        // Bot filled the hidden field — silently pretend success.
        $formSuccess = true;
    } else {
        if ($old['name'] === '') {
            $errors['name'] = 'Please tell us your name.';
        }
        if ($old['email'] === '') {
            $errors['email'] = 'Please add your email address.';
        } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'That email address doesn\'t look valid.';
        }
        if ($old['message'] === '') {
            $errors['message'] = 'Please write a short message.';
        }

        if (empty($errors)) {
            // Persist the submission so nothing is lost even before SMTP is wired up.
            $logDir  = dirname(CONTACT_LOG_FILE);
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0775, true);
            }
            $line = date('c') . '|' . $old['name'] . '|' . $old['email'] . '|' . str_replace(["\r", "\n"], ' ', $old['message']) . "\n";
            @file_put_contents(CONTACT_LOG_FILE, $line, FILE_APPEND);

            // TODO: wire up mail()/SMTP to send this to CONTACT_EMAIL.
            // @mail(CONTACT_EMAIL, 'New Carry the Cross message', $old['message'], 'From: ' . $old['email']);

            $formSuccess = true;
            $old = ['name' => '', 'email' => '', 'message' => ''];
        }
    }
}

$pageTitle = 'Contact';
$pageDesc  = 'Get in touch with the Carry the Cross ministry — ask a question, request group pricing, or just say hello.';
require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
      <div class="wrap">
        <span class="eyebrow">Say hello</span>
        <h1>Contact the ministry</h1>
        <p class="lede">Questions, group orders, or a story to share — we'd love to hear from you.</p>
      </div>
    </section>

    <?= render_braid_divider(1) ?>

    <section class="section">
      <div class="wrap grid-2">

        <div class="reveal">
          <div class="order-panel">
            <p class="eyebrow">Send a message</p>
            <h2 style="font-family:var(--font-display); font-size:clamp(24px,3vw,30px); margin:6px 0 18px;">We usually reply within a day</h2>

            <?php if ($formSuccess): ?>
              <div class="form-success">
                Thank you — your message is on its way. We'll get back to you as soon as we can. God bless.
              </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
              <div class="form-summary">Please fix the fields highlighted below and try again.</div>
            <?php endif; ?>

            <form method="post" action="contact.php" novalidate>
              <div style="position:relative;">
                <div class="honeypot" aria-hidden="true">
                  <label for="website">Website</label>
                  <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>
              </div>

              <div class="form-field<?= isset($errors['name']) ? ' has-error' : '' ?>">
                <label for="name">Your name</label>
                <input type="text" id="name" name="name" value="<?= e($old['name']) ?>" autocomplete="name" required>
                <?php if (isset($errors['name'])): ?><span class="field-error" role="alert"><?= e($errors['name']) ?></span><?php endif; ?>
              </div>

              <div class="form-field<?= isset($errors['email']) ? ' has-error' : '' ?>">
                <label for="email">Your email</label>
                <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" autocomplete="email" required>
                <?php if (isset($errors['email'])): ?><span class="field-error" role="alert"><?= e($errors['email']) ?></span><?php endif; ?>
              </div>

              <div class="form-field<?= isset($errors['message']) ? ' has-error' : '' ?>">
                <label for="message">Message</label>
                <textarea id="message" name="message" required><?= e($old['message']) ?></textarea>
                <?php if (isset($errors['message'])): ?><span class="field-error" role="alert"><?= e($errors['message']) ?></span><?php endif; ?>
              </div>

              <div class="order-form-actions">
                <button type="submit" class="btn btn-primary">Send message</button>
              </div>
            </form>
          </div>
        </div>

        <div class="stack">
          <div class="order-panel reveal">
            <h3 style="font-family:var(--font-display); font-size:20px; margin-bottom:12px;">Email us directly</h3>
            <p style="font-size:15px; color:var(--text-secondary); margin-bottom:18px;">
              Prefer email? Write to us any time.
            </p>
            <a href="mailto:<?= e(CONTACT_EMAIL) ?>" class="btn btn-outline"><?= e(CONTACT_EMAIL) ?></a>
          </div>

          <div class="order-panel reveal">
            <h3 style="font-family:var(--font-display); font-size:20px; margin-bottom:12px;">Group orders</h3>
            <p style="font-size:15px; color:var(--text-secondary); line-height:1.7;">
              Churches and youth groups often order in bulk for events and mission trips. Email us for group pricing and scheduling.
            </p>
          </div>

          <div class="order-panel reveal">
            <h3 style="font-family:var(--font-display); font-size:20px; margin-bottom:12px;">Find us online</h3>
            <div class="footer-social">
              <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3c-2 0-3.5 1.5-3.5 3.5V11H8v3h2.5v6h3v-6H16l.5-3h-3V9.6c0-.3.2-.6.5-.6Z" stroke="currentColor" stroke-width="1.4"/></svg></a>
              <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="16" height="16" rx="4" stroke="currentColor" stroke-width="1.4"/><circle cx="12" cy="12" r="3.4" stroke="currentColor" stroke-width="1.4"/><circle cx="16.6" cy="7.4" r="1" fill="currentColor"/></svg></a>
              <a href="#" aria-label="TikTok"><svg viewBox="0 0 24 24" fill="none"><path d="M14 4v9.5a2.8 2.8 0 1 1-2.4-2.77M14 4c.3 2 1.7 3.5 3.7 3.7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></a>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/footer.php'; ?>