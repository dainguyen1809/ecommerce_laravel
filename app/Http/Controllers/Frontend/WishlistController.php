<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.pages.wishlist', [
            'wishlists' => $wishlists,
        ]);
    }

    public function addToWishlist(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $wishlistCount = Wishlist::where([
            'product_id' => $request->id,
            'user_id' => Auth::user()->id,
        ])->count();

        if ($wishlistCount > 0) {
            return response()->json([
                'status' => 'warning',
                'message' => 'The product is already on your wishlist'
            ]);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        $count = Wishlist::where('user_id', Auth::user()->id)->count();

        return response()->json([
            'status' => 'success',
            'count' => $count,
            'message' => 'Done',
        ]);
    }

    public function removeWishlistProduct($id)
    {

        $wishlists = Wishlist::where('id', $id)->firstOrFail();
        if ($wishlists->user_id !== Auth::user()->id) {
            return redirect()->back();
        }
        $wishlists->delete();

        toastr('Removed', 'success');
        return redirect()->back();
    }
}
