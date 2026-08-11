(function() {
  'use strict';

  var html = document.documentElement;

  // --- Theme Toggle ---
  var themeToggle = document.getElementById('themeToggle');

  var savedTheme = null;
  try { savedTheme = localStorage.getItem('theme'); } catch (err) {}

  if (savedTheme === 'dark') {
    html.setAttribute('data-theme', 'dark');
  } else {
    html.removeAttribute('data-theme');
  }

  if (themeToggle) {
    themeToggle.addEventListener('click', function() {
      var isDark = html.getAttribute('data-theme') === 'dark';
      if (isDark) {
        html.removeAttribute('data-theme');
        try { localStorage.setItem('theme', 'light'); } catch (err) {}
      } else {
        html.setAttribute('data-theme', 'dark');
        try { localStorage.setItem('theme', 'dark'); } catch (err) {}
      }
    });
  }

  // --- Mobile nav ---
  var toggle = document.getElementById('nav-toggle');
  var nav = document.getElementById('main-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function() {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.querySelectorAll('a').forEach(function(a) {
      a.addEventListener('click', function() {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // --- Smooth scroll for same-page anchors only ---
  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        var headerOffset = 80;
        var elementPosition = target.getBoundingClientRect().top;
        var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // --- Quantity steppers (order form + cart lines) ---
  function clamp(v) {
    v = parseInt(v, 10);
    if (isNaN(v)) v = 1;
    return Math.min(200, Math.max(1, v));
  }

  function bindStep(input) {
    var btnDown = input.previousElementSibling;
    var btnUp = input.nextElementSibling;
    var qtyDec = document.getElementById('qty-dec');
    var qtyInc = document.getElementById('qty-inc');

    if ((btnDown && btnDown.classList.contains('qty-btn')) ||
        (btnUp && btnUp.classList.contains('qty-btn'))) {
      var down = btnDown && btnDown.classList.contains('qty-btn') ? btnDown : null;
      var up = btnUp && btnUp.classList.contains('qty-btn') ? btnUp : null;
      if (down) down.addEventListener('click', function() {
        input.value = clamp(input.value) - 1;
        input.dispatchEvent(new Event('change', { bubbles: true }));
      });
      if (up) up.addEventListener('click', function() {
        input.value = clamp(input.value) + 1;
        input.dispatchEvent(new Event('change', { bubbles: true }));
      });
      return;
    }

    if (qtyDec) qtyDec.addEventListener('click', function() {
      input.value = clamp(input.value) - 1;
      updateOrderTotal();
    });
    if (qtyInc) qtyInc.addEventListener('click', function() {
      input.value = clamp(input.value) + 1;
      updateOrderTotal();
    });
  }

  // Order page subtotal
  var unitPrice = parseFloat(document.querySelector('body').dataset.unitPrice || '7.00');
  var qtyInput = document.getElementById('quantity');
  var totalEl = document.getElementById('order-total-amount');

  function updateOrderTotal() {
    if (!qtyInput || !totalEl) return;
    var q = clamp(qtyInput.value);
    qtyInput.value = q;
    totalEl.textContent = (unitPrice * q).toFixed(2);
  }
  if (qtyInput) {
    bindStep(qtyInput);
    qtyInput.addEventListener('input', updateOrderTotal);
    updateOrderTotal();
  }

  // Cart line inputs: keep line totals in sync
  document.querySelectorAll('input.qty-input').forEach(function(input) {
    bindStep(input);
    input.addEventListener('input', function() {
      var lineTotal = document.querySelector('[data-line-for="' + input.dataset.qtyFor + '"]');
      if (lineTotal) lineTotal.textContent = (unitPrice * clamp(input.value)).toFixed(2);
    });
    input.addEventListener('change', function() {
      var form = input.closest('form[data-cart-action]');
      if (!form) return;
      if (form.requestSubmit) {
        form.requestSubmit();
      } else {
        form.submit();
      }
    });
  });

  // --- Gallery swap ---
  var thumbs = document.querySelectorAll('.gallery-thumb');
  var main = document.getElementById('gallery-main');
  var galleryState = localStorage.getItem('weave') || 'diagonal';
  thumbs.forEach(function(t) {
    t.addEventListener('click', function() {
      thumbs.forEach(function(x) { x.classList.remove('active'); });
      t.classList.add('active');
      try { localStorage.setItem('weave', t.dataset.weave); } catch (err) {}
      if (main) {
        main.style.opacity = 0;
        setTimeout(function() {
          main.innerHTML = t.querySelector('svg').outerHTML;
          main.style.opacity = 1;
        }, 180);
      }
    });
  });
  if (main) {
    main.style.transition = 'opacity 0.25s ease';
    var activeThumb = document.querySelector('.gallery-thumb[data-weave="' + galleryState + '"]');
    if (activeThumb) {
      activeThumb.classList.add('active');
      main.innerHTML = activeThumb.querySelector('svg').outerHTML;
    }
  }

  // --- Cart helpers ---
  function updateCartPill(count) {
    var pill = document.getElementById('cart-count');
    if (pill && count != null) pill.textContent = count;
  }

  // --- Add to cart (AJAX with non-JS fallback to cart.php) ---
  var orderForm = document.getElementById('order-form');
  if (orderForm) {
    orderForm.addEventListener('submit', function(e) {
      e.preventDefault();
      var q = parseInt(document.getElementById('quantity').value, 10) || 1;
      var body = new URLSearchParams();
      body.set('action', 'add');
      body.set('quantity', q);

      fetch('cart.php', {
        method: 'POST',
        body: body,
        headers: { 'X-Requested-With': 'fetch' }
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        updateCartPill(data.count);
        var feedback = document.getElementById('orderFeedback');
        if (feedback) {
          feedback.textContent = data.message || ('Added to your cart. You now have ' + data.count + ' in your cart.');
          feedback.style.display = 'block';
          setTimeout(function() { feedback.style.display = 'none'; }, 4000);
        }
      })
      .catch(function() {
        window.location.href = 'cart.php';
      });
    });
  }

  // --- Cart actions (update / remove) via AJAX ---
  function cartAjax(formEl, success) {
    var body = new URLSearchParams(new FormData(formEl));
    fetch('cart.php', {
      method: 'POST',
      body: body,
      headers: { 'X-Requested-With': 'fetch' }
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      updateCartPill(data.count);
      if (success) success(data);
    })
    .catch(function() {
      window.location.href = 'cart.php';
    });
  }

  document.querySelectorAll('form[data-cart-action]').forEach(function(f) {
    f.addEventListener('submit', function(e) {
      e.preventDefault();
      var action = f.dataset.cartAction;
      var row = f.closest('.cart-item');

      cartAjax(f, function(data) {
        if (action === 'remove') {
          if (row) row.remove();
          if (data.count === 0) window.location.reload();
          return;
        }
        if (data.count === 0) {
          window.location.reload();
          return;
        }
        var lineTotal = row ? row.querySelector('[data-line-total]') : null;
        if (lineTotal && data.lineTotal != null) lineTotal.textContent = data.lineTotal;
        var subtotal = document.querySelector('[data-cart-subtotal]');
        if (subtotal && data.subtotal != null) subtotal.textContent = data.subtotal;
      });
    });
  });

  // --- FAQ accordion (graceful without JS: all answers visible) ---
  var faqItems = document.querySelectorAll('.faq-item');
  if (faqItems.length) {
    var firstOpen = null;
    faqItems.forEach(function(item, i) {
      var btn = item.querySelector('.faq-toggle');
      var panel = item.querySelector('.faq-panel');
      if (!btn || !panel) return;
      var answer = panel.querySelector('.faq-answer');
      if (i === 0) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
        firstOpen = item;
      } else {
        item.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        panel.style.display = 'none';
      }
      btn.addEventListener('click', function() {
        var isOpen = item.classList.contains('open');
        faqItems.forEach(function(other) {
          other.classList.remove('open');
          var ob = other.querySelector('.faq-toggle');
          var op = other.querySelector('.faq-panel');
          if (ob) ob.setAttribute('aria-expanded', 'false');
          if (op) op.style.display = 'none';
        });
        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
          panel.style.display = '';
        }
      });
    });
  }

  // --- Scroll reveal ---
  var revealEls = document.querySelectorAll('.reveal');
  var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) {
    revealEls.forEach(function(el) { el.classList.add('is-visible'); });
  } else if ('IntersectionObserver' in window && revealEls.length) {
    var io = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function(el) { io.observe(el); });
  } else {
    revealEls.forEach(function(el) { el.classList.add('is-visible'); });
  }
})();