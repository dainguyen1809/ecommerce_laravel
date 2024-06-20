<?php

// check discount

use Gloudemans\Shoppingcart\Facades\Cart;

function checkDiscount($product)
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price > 0 &&
        $currentDate >= $product->offer_start_date &&
        $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

function calculateDiscountPercent($original, $discount)
{
    $discountAmount = $original - $discount;
    $discountPercent = round(($discountAmount / $original) * 100);

    return $discountPercent;
}

// format product type | New_arrival
function formatProductType($type) : string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
        case 'featured_product':
            return 'Featured';
        case 'best_product':
            return 'Best';
        default:
            return '';
    }
}

function getCartTotalAmount()
{
    $total = 0;
    foreach (Cart::content() as $product) {
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

function getMainCartTotal()
{
    if (session()->has('coupon')) {
        $coupon = session()->get('coupon');
        $subTotal = getCartTotalAmount();
        if ($coupon['discount_type'] === 'amount') {
            $total = $subTotal - $coupon['discount'];
            return $total;
        } else if ($coupon['discount_type'] === 'percent') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    } else {
        return getCartTotalAmount();
    }
}

function getCartDiscount()
{
    if (session()->has('coupon')) {
        $coupon = session()->get('coupon');
        $subTotal = getCartTotalAmount();
        if ($coupon['discount_type'] === 'amount') {
            $total = $subTotal - $coupon['discount'];
            return $coupon['discount'];
        } else if ($coupon['discount_type'] === 'percent') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    } else {
        return 0;
    }
}