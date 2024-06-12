<?php

// check discount
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