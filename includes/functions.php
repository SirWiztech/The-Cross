<?php
// Render helpers shared across every page.

if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

// Format a number as a currency string (e.g. "$7.00").
function money($amount)
{
    return CURRENCY_SYMBOL . number_format((float)$amount, 2);
}

// Which nav link should be marked active, based on the current filename.
function is_active($file)
{
    return basename($_SERVER['SCRIPT_NAME']) === $file ? 'active' : '';
}

// The signature interlocking red/white chevron braid divider.
function render_braid_divider($variant = 1)
{
    $id = 'braidPattern' . (int)$variant;
    return '<div class="braid" role="presentation" aria-hidden="true">'
        . '<svg viewBox="0 0 480 28" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">'
        . '<defs>'
        . '<pattern id="' . $id . '" width="40" height="28" patternUnits="userSpaceOnUse">'
        . '<rect width="40" height="28" fill="none" />'
        . '<path d="M0 14 L10 0 L20 14 L10 28 Z" fill="#E54B4B" opacity="0.8" />'
        . '<path d="M20 14 L30 0 L40 14 L30 28 Z" fill="#F2EBE5" opacity="0.15" stroke="#E54B4B" stroke-width="1" />'
        . '</pattern>'
        . '</defs>'
        . '<rect width="480" height="28" fill="url(#' . $id . ')" />'
        . '</svg>'
        . '</div>';
}

// The hand-drawn woven cross with brass keyring loop.
// $weave: array with 'rot'/'rot2' from $galleryWeaves (defaults to classic diagonal).
// $prefix: unique id prefix so multiple crosses can share a page.
function render_cross_svg($weave = null, $prefix = 'cross', $width = 280)
{
    if ($weave === null) {
        $weave = ['rot' => 45, 'rot2' => -45];
    }
    $rot  = (int)$weave['rot'];
    $rot2 = (int)$weave['rot2'];
    $p1 = $prefix . 'w';
    $p2 = $prefix . 'h';
    $f  = $prefix . 's';
    $rg = $prefix . 'rg';

    return '<svg viewBox="0 0 340 380" width="' . (int)$width . '" height="auto" role="img" aria-label="Handmade paracord cross" xmlns="http://www.w3.org/2000/svg">'
        . '<defs>'
        . '<pattern id="' . $p1 . '" width="16" height="16" patternTransform="rotate(' . $rot . ')" patternUnits="userSpaceOnUse">'
        . '<rect width="16" height="16" fill="#F2EBE5" /><rect width="8" height="16" fill="#E54B4B" />'
        . '</pattern>'
        . '<pattern id="' . $p2 . '" width="16" height="16" patternTransform="rotate(' . $rot2 . ')" patternUnits="userSpaceOnUse">'
        . '<rect width="16" height="16" fill="#E54B4B" /><rect width="8" height="16" fill="#F2EBE5" />'
        . '</pattern>'
        . '<filter id="' . $f . '" x="-40%" y="-40%" width="180%" height="180%">'
        . '<feDropShadow dx="0" dy="12" stdDeviation="18" flood-color="#000" flood-opacity="0.5" />'
        . '</filter>'
        . '<radialGradient id="' . $rg . '" cx="35%" cy="30%" r="75%">'
        . '<stop offset="0%" stop-color="#d4c0b0" /><stop offset="55%" stop-color="#a58a78" /><stop offset="100%" stop-color="#5c4a3d" />'
        . '</radialGradient>'
        . '</defs>'
        . '<g filter="url(#' . $f . ')">'
        . '<circle cx="170" cy="46" r="30" fill="none" stroke="url(#' . $rg . ')" stroke-width="9" />'
        . '<path d="M170 76 C170 96, 170 96, 170 110" stroke="#E54B4B" stroke-width="14" stroke-linecap="round" fill="none" />'
        . '<rect x="140" y="100" width="60" height="250" rx="16" fill="url(#' . $p1 . ')" stroke="#6d1521" stroke-width="2" />'
        . '<rect x="55" y="175" width="230" height="60" rx="16" fill="url(#' . $p2 . ')" stroke="#6d1521" stroke-width="2" />'
        . '<g fill="#3c1015" opacity="0.4">'
        . '<circle cx="170" cy="130" r="2.4" />'
        . '<circle cx="170" cy="150" r="2.4" />'
        . '<circle cx="170" cy="260" r="2.4" />'
        . '<circle cx="170" cy="300" r="2.4" />'
        . '<circle cx="90" cy="205" r="2.4" />'
        . '<circle cx="120" cy="205" r="2.4" />'
        . '<circle cx="220" cy="205" r="2.4" />'
        . '<circle cx="250" cy="205" r="2.4" />'
        . '</g>'
        . '</g>'
        . '</svg>';
}

// Hand-drawn inline icons used by data-driven cards.
function render_icon($name, $stroke = 'currentColor', $fill = 'none')
{
    $paths = [
        'heart'    => '<path d="M12 3s7 7.6 7 12a7 7 0 1 1-14 0c0-4.4 7-12 7-12Z" stroke="' . $stroke . '" stroke-width="1.8"/>',
        'sparkle'  => '<path d="M12 4v4M12 16v4M4 12h4M16 12h4M6.5 6.5l2.5 2.5M15 15l2.5 2.5M17.5 6.5 15 9M9 15l-2.5 2.5" stroke="' . $stroke . '" stroke-width="1.8" stroke-linecap="round"/>',
        'cross'    => '<path d="M12 3v18M6 8h12" stroke="' . $stroke . '" stroke-width="1.8" stroke-linecap="round"/>',
        'check'    => '<path d="m5 13 4 4 10-10" stroke="' . $stroke . '" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'shield'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="' . $stroke . '" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'box'      => '<path d="M4 4h16v16H4z"/><path d="M4 9h16"/><path d="M4 15h16" stroke="' . $stroke . '" stroke-width="2.2"/>',
        'home'     => '<path d="M3 11.5 12 4l9 7.5M5 10v10h5v-6h4v6h5V10" stroke="' . $stroke . '" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
        'book'     => '<path d="M4 5a2 2 0 0 1 2-2h5v18H6a2 2 0 0 1-2-2V5Zm16 0a2 2 0 0 0-2-2h-5v18h5a2 2 0 0 0 2-2V5Z" stroke="' . $stroke . '" stroke-width="1.7" stroke-linejoin="round"/>',
        'cart'     => '<path d="M4 5h2l2.4 9.5a2 2 0 0 0 2 1.5h6.7a2 2 0 0 0 1.9-1.4L21 8H7M9.5 20.5h.01M17.5 20.5h.01" stroke="' . $stroke . '" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
        'question' => '<circle cx="12" cy="12" r="9" stroke="' . $stroke . '" stroke-width="1.7"/><path d="M9.4 9.2a2.6 2.6 0 1 1 3.9 2.2c-.9.6-1.3 1-1.3 1.9M12 16.8h.01" stroke="' . $stroke . '" stroke-width="1.8" stroke-linecap="round"/>',
        'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2" stroke="' . $stroke . '" stroke-width="1.7"/><path d="m4 7 8 6 8-6" stroke="' . $stroke . '" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
    ];
    if (!isset($paths[$name])) {
        return '';
    }
    return '<svg viewBox="0 0 24 24" fill="' . $fill . '" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' . $paths[$name] . '</svg>';
}