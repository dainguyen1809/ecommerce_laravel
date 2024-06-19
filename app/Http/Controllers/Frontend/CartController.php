<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
}
