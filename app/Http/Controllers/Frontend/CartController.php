<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        if ($product->quantity === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product stock out!',
            ]);
        } else if ($product->quantity < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product quantity unavailable in our stock!',
            ]);
        }

        $variants = [];
        $variantTotalAmount = 0;
        $productTotalAmount = 0;
        $productPrice = 0;

        if ($request->has('variant_items')) {
            foreach ($request->variant_items as $product_variant_id) {
                $variantItem = ProductVariantItem::find($product_variant_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }

        $cart = [];
        $cart['id'] = $product->id;
        $cart['name'] = $product->name;
        $cart['qty'] = $request->quantity;
        $cart['price'] = $productPrice;
        $cart['weight'] = 0;
        $cart['options']['variants'] = $variants;
        $cart['options']['variants_total'] = $variantTotalAmount;
        $cart['options']['image'] = $product->thumb_image;
        $cart['options']['slug'] = $product->slug;

        Cart::add($cart);

        return response([
            'status' => 'success',
            'message' => 'Add to cart successfully',
        ]);

    }

    public function cartDetails()
    {
        $cartItems = Cart::content();

        if (count($cartItems) === 0) {
            session()->forget('coupon');
            toastr('Please add some products to your cart!', 'warning', 'Cart Is Empty!');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', [
            'cartItems' => $cartItems,
        ]);
    }

    public function updateProductQuantity(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
        if ($product->quantity === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product stock out!',
            ]);
        } else if ($product->quantity < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product quantity unavailable in our stock!',
            ]);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response()->json([
            'status' => 'success',
            'message' => 'Product Quantity Updated!',
            'product_total' => $productTotal,
        ]);
    }

    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    public function clearCart()
    {
        Cart::destroy();

        return response()->json([
            'status' => 'success',
            'message' => 'Done !',
        ]);
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }


    public function getCartCount()
    {
        return Cart::content()->count();
    }

    public function getCartProducts()
    {
        return Cart::content();
    }

    public function sidebarRemoveProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response()->json([
            'status' => 'success',
            'message' => 'Removed',
        ]);
    }

    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon field is required !',
            ]);
        }

        $coupon = Coupon::where([
            'code' => $request->coupon_code,
            'status' => 1,
        ])->first();

        if ($coupon === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon does not exist!',
            ]);
        } else if ($coupon->start_date > date('Y-m-d')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon expired !',
            ]);
        } else if ($coupon->end_date < date('Y-m-d')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon expired !',
            ]);
        } else if ($coupon->total_used >= $coupon->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot apply this coupon!',
            ]);
        }

        if ($coupon->discount_type === 'amount') {
            session()->put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount,
            ]);
        } elseif ($coupon->discount_type === 'percent') {
            session()->put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon applied successfully',
        ]);
    }

    public function couponCalculation()
    {
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $subTotal = getCartTotalAmount();
            if ($coupon['discount_type'] === 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response()->json([
                    'status' => 'success',
                    'cart_total' => $total,
                    'discount' => $coupon['discount'],
                ]);
            } else if ($coupon['discount_type'] === 'percent') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response()->json([
                    'status' => 'success',
                    'cart_total' => $total,
                    'discount' => $discount,
                ]);
            }
        } else {
            $total = getCartTotalAmount();
            return response()->json([
                'status' => 'success',
                'cart_total' => $total,
                'discount' => 0,
            ]);
        }
    }
}
