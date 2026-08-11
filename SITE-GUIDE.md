# Carry the Cross — Site Guide

A complete, mobile-friendly PHP website for **Carry the Cross** — 9 pages sharing one
header, footer, and design system. It is vanilla PHP + vanilla JavaScript: no framework,
no build step. It runs on any standard PHP host (WAMP included).

---

## The pages

| Page | What it does |
|---|---|
| `index.php` | Home. Hero with photo background + logo, the "message behind the colors" teaser, a featured product block, and calls to action. |
| `the-message.php` | The full red/white meaning story, the Isaiah 1:18 scripture, and the three color cards. |
| `about.php` | The ministry story, mission (faith / hope / love), with a woven-cross illustration. |
| `order.php` | The order experience: pick a weave pattern (4 thumbnails swap the preview), pick a quantity, add to cart. |
| `faq.php` | An 8-question accordion (works even with JavaScript off). |
| `contact.php` | Contact form with validation and spam protection. |
| `cart.php` | The session cart: change quantity, remove items, see subtotal, go to checkout. |
| `checkout.php` | Shipping details form with server-side validation, plus an order summary. |
| `order-confirmation.php` | Thank-you page that shows the order reference after checkout. |

---

## Features

### Visitor-facing
- Sticky full-width header with the logo, an icon + label nav, a **live cart pill** (updates on every page), and a **dark/light theme toggle** (the visitor's choice is remembered).
- Hand-tied woven-cross artwork everywhere (the SVG system) — the logo in the hero, nav, and footer; the hero photo as a background.
- Add-to-cart works with AJAX (smooth, no page jump) and falls back to a normal form if JavaScript is off.
- Checkout generates an order reference like `CTC-XXXXXX`, confirms by email (see caveats), and clears the cart.
- Accessible: real forms/labels/buttons, keyboard focus rings, and `prefers-reduced-motion` respected.
- Fully responsive down to ~360px; cart/checkout collapse to stacked cards on phones.

### Owner-facing (behind the scenes)
- All content lives in `includes/data.php` — colors, features, FAQ, gallery weaves, nav links, story text. A non-developer can edit text there without touching page code.
- Site-wide settings live in `config.php`: site name, tagline, contact email, currency, price, and order prefix. Change the price in one place and the whole site updates.
- Contact submissions are saved to `data/contact-submissions.log` so no message is ever lost, even before email is wired up.
- `includes/header.php`, `footer.php`, `cart-session.php`, and `functions.php` keep the chrome, cart logic, and artwork shared so nothing is duplicated.

---

## How to use the site

### Run it locally (WAMP or anywhere)
- Point your web root at the project folder (`C:\wamp64\www\The-Cross`), or just run
  `php -S localhost:8000` from the folder and open `http://localhost:8000`.

### The order flow (what a customer experiences)
1. **Order page** → choose a weave, set a quantity → "Add to cart".
2. **Cart page** → tweak quantity or remove → "Proceed to checkout".
3. **Checkout** → fill in name / email / address → "Place order" → confirmation page with the order reference.
4. **You** then receive the details to confirm shipping cost by email (no payment is taken online — see caveats).

### Editing content
- **Text / FAQ / colors / gallery / nav**: open `includes/data.php` and edit the arrays.
  For example, to add a FAQ question, copy an existing `[...]` entry and change the text.
- **Price, site name, contact email, order prefix**: edit `config.php`.
- **Theme**: dark mode is toggled in the header; the site remembers each visitor's choice.

---

## File map

```
/
├── index.php                  → Home
├── the-message.php            → The message story
├── about.php                  → Ministry story
├── order.php                  → Order experience
├── faq.php                    → FAQ accordion
├── contact.php                → Contact form
├── cart.php                   → Session cart
├── checkout.php               → Shipping + order summary
├── order-confirmation.php     → Thank-you page
├── config.php                 → Site-wide settings
├── includes/
│   ├── header.php             → Shared <head>, nav, cart pill
│   ├── footer.php             → Shared footer
│   ├── data.php               → All editable content
│   ├── functions.php          → SVG artwork + helpers
│   └── cart-session.php       → Cart / session logic
├── assets/
│   ├── css/style.css          → Shared styles
│   ├── js/main.js             → Shared interactions
│   └── img/                   → Logo images
└── data/                      → Contact submission log (created at runtime)
```

---

## Caveats to know

- **No online payment.** This is a "we confirm by email" ministry flow, matching the
  original "Order by email" option. Checkout keeps an order-by-email shortcut too.
- **Contact/order emails are stubbed.** Contact messages are logged to
  `data/contact-submissions.log`; there is a `// TODO: wire up mail()/SMTP` marker in
  `contact.php` for when real email sending is ready. Order confirmations are shown on
  screen (not emailed) for now.
- **The cart is per-visitor session**, so it resets when the visitor closes the browser —
  nothing is stored in a database.
