<?php
// Central content store for Carry the Cross.
// Non-technical editors can safely change these arrays — every page renders from them.

if (!defined('UNIT_PRICE')) require_once __DIR__ . '/../config.php';

// Shared navigation. 'file' is the filename to compare against for active state,
// 'icon' is the hand-drawn SVG icon rendered beside the label.
$navLinks = [
    ['file' => 'index.php',          'href' => 'index.php',          'label' => 'Home',        'icon' => 'home'],
    ['file' => 'the-message.php',    'href' => 'the-message.php',    'label' => 'The Message', 'icon' => 'book'],
    ['file' => 'about.php',          'href' => 'about.php',          'label' => 'About',       'icon' => 'heart'],
    ['file' => 'order.php',          'href' => 'order.php',          'label' => 'Order',       'icon' => 'cart'],
    ['file' => 'faq.php',            'href' => 'faq.php',            'label' => 'FAQ',         'icon' => 'question'],
    ['file' => 'contact.php',        'href' => 'contact.php',        'label' => 'Contact',     'icon' => 'mail'],
];

// Color meanings — rendered as the color cards in "The Message" sections.
$colorMeanings = [
    [
        'id'      => 'red',
        'icon'    => 'heart', // see render_icon() in functions.php
        'title'   => 'Red',
        'body'    => 'The red strands carry the memory of the blood of Christ, shed once for sin. It is the color the whole cross is tied around.',
    ],
    [
        'id'      => 'white',
        'icon'    => 'sparkle',
        'title'   => 'White',
        'body'    => 'The white strands are woven in for the forgiveness and cleansing we are given through Him — scarlet made new.',
    ],
    [
        'id'      => 'cross',
        'icon'    => 'cross',
        'title'   => 'The Cross',
        'body'    => 'The shape itself is the reminder: the greatest love ever given, worn on a keychain, a wrist, a bag — wherever you go.',
    ],
];

// Order panel feature list.
$features = [
    [
        'icon' => 'check',
        'title' => 'Handmade with purpose',
        'body'  => 'Every cross is hand-tied, cord over cord, with care and prayer — not stamped from a machine.',
    ],
    [
        'icon' => 'shield',
        'title' => 'Made to give away',
        'body'  => 'Carry one, or carry a handful. Most people order a few extra for someone who needs the reminder.',
    ],
    [
        'icon' => 'box',
        'title' => 'Shipped with care',
        'body'  => 'Every order ships within days of being tied. Shipping is calculated once at checkout — no surprises.',
    ],
];

// FAQ items — full accordion on faq.php.
$faqItems = [
    [
        'q' => 'How long does it take to receive my order?',
        'a' => 'Every cross is tied to order, so please allow a few extra days for it to be tied and shipped. Domestic orders typically arrive within 5–10 business days from checkout. You will always receive a confirmation once your order ships.',
    ],
    [
        'q' => 'Can I order in bulk for my church or youth group?',
        'a' => 'Yes — many churches and youth groups order in bulk for events, mission trips, and VBS programs. Email us at ' . CONTACT_EMAIL . ' for group pricing and scheduling. Bulk orders get priority on the tying bench.',
    ],
    [
        'q' => 'Where does the money go?',
        'a' => 'Every dollar beyond materials and shipping goes directly back into the ministry. This site exists to share the message, not to profit — the price simply covers cord, hardware, and postage.',
    ],
    [
        'q' => 'What materials are the crosses made from?',
        'a' => 'Each cross is hand-tied from military-grade nylon paracord in two colors — scarlet red and white — carried on a brass keyring. The cord is durable, water-resistant, and built to hold up to daily wear.',
    ],
    [
        'q' => 'How do I care for my cross?',
        'a' => 'The paracord needs almost no care. If it gets muddy or dusty, rinse it with cool water and let it air dry. Avoid leaving it in direct, constant sunlight for months at a time, which can fade the colors.',
    ],
    [
        'q' => 'Do you ship internationally?',
        'a' => 'Yes, we ship internationally. International orders take a bit longer and shipping is calculated at checkout so you know the exact cost before you confirm. Some destinations may see customs delays.',
    ],
    [
        'q' => 'Can I return or exchange a cross?',
        'a' => 'If your cross arrives damaged or with a defect, we will replace it — no questions asked. Because each cross is tied by hand to order, we cannot accept returns for change-of-mind, but the gospel of the cross lasts forever.',
    ],
    [
        'q' => 'The red and white colors — what do they mean?',
        'a' => 'Red stands for the blood of Christ, shed once for sin. White stands for the cleansing and forgiveness we receive through Him. Together they tell the message from Isaiah 1:18 — scarlet made white as snow.',
    ],
];

// Gallery weave variants for order.php. 'rot' controls the cord pattern direction.
$galleryWeaves = [
    ['id' => 'diagonal',      'label' => 'Classic weave',   'rot' => 45,  'rot2' => -45],
    ['id' => 'chevron',       'label' => 'Chevron weave',   'rot' => 20,  'rot2' => -20],
    ['id' => 'diamond',       'label' => 'Diamond weave',   'rot' => 90,  'rot2' => -90],
    ['id' => 'diagonal-rev',  'label' => 'Reverse diagonal','rot' => -45, 'rot2' => 45],
];

// Hero strands of the "message" story (the-message.php).
$messageStory = [
    [
        'heading' => 'Scarlet',
        'body'    => 'Red is the color of blood — and the Bible uses it for sin. When the prophet wrote that our sins are as scarlet, he chose the most stubborn dye known to the ancient world. No amount of washing could lift it. In the same way, no amount of self-effort can remove the stain of sin on us.',
    ],
    [
        'heading' => 'White as snow',
        'body'    => 'White is the promise of cleansing that only God can give. Through the cross, the stain we could not wash away is removed completely — not because we were good enough, but because Christ was. Scarlet becomes white as snow.',
    ],
    [
        'heading' => 'The tie that holds it all',
        'body'    => 'A cross made of cord is a perfect picture: strands woven together, each one dependent on the rest. Every knot in your cross was prayerfully tied. Wear it as a reminder that redemption is a gift, and share it so others can carry it too.',
    ],
];

// About page story paragraphs.
$aboutStory = [
    'Carry the Cross began with a single knot and a simple question: what if a small, handmade cross could carry a big message?',
    'We tie each cross by hand, cord over cord, with the colors of the gospel woven into every strand. The red speaks of the blood of Christ. The white speaks of the forgiveness He offers. The shape itself — the cross — is the greatest love ever given.',
    'Every cross is made to be given away. Carry one on your keychain, your wrist, or your bag. When someone asks, hand them a story: redemption is real, the price was paid, and the message is for them.',
    'This ministry is not about profit. The price of each cross simply covers materials and shipping. Every dollar beyond that goes straight back into sharing the message — one cord, one cross, one conversation at a time.',
];