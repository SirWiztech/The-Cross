<?php
// Session cart: bootstrap + all add/update/remove/total logic.
// Include this file wherever cart or checkout state is needed, BEFORE any output.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';

// Cart lives in $_SESSION['cart'] as ['quantity' => int].

function cart_add($qty)
{
    $qty = (int)$qty;
    if ($qty < 1) $qty = 1;
    if ($qty > 200) $qty = 200;
    $_SESSION['cart']['quantity'] = (int)($_SESSION['cart']['quantity'] ?? 0) + $qty;
}

function cart_set($qty)
{
    $qty = (int)$qty;
    if ($qty < 1) $qty = 1;
    if ($qty > 200) $qty = 200;
    $_SESSION['cart']['quantity'] = $qty;
}

function cart_remove()
{
    unset($_SESSION['cart']);
}

function cart_count()
{
    return (int)($_SESSION['cart']['quantity'] ?? 0);
}

function cart_subtotal()
{
    return cart_count() * UNIT_PRICE;
}

function cart_has_items()
{
    return cart_count() > 0;
}

// Process a POSTed cart action (add / update / remove / clear).
function handle_cart_action()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    $action = isset($_POST['action']) ? (string)$_POST['action'] : '';
    $qty    = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    switch ($action) {
        case 'add':
            cart_add($qty);
            break;
        case 'update':
            cart_set($qty);
            break;
        case 'remove':
        case 'clear':
            cart_remove();
            break;
    }
}