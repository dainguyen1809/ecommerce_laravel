<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use UploadImage;

    public function index(UserProductReviewsDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.review.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required|max:255',
            'images.*' => 'image|max:2048',
        ]);

        $reviewExist = ProductReview::where([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
        ])->first();

        if ($reviewExist) {
            toastr('You already added a review for this product!', 'warning');

            return redirect()->back();
        }

        $imgPaths = $this->uploadMultiImage($request, 'images', 'images/review');

        $productReview = new ProductReview();
        $productReview->product_id = $request->product_id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->user_id = Auth::user()->id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = 0;
        $productReview->save();

        if (! empty($imgPaths)) {
            foreach ($imgPaths as $path) {
                $reviewGallery = new ProductReviewGallery();
                $reviewGallery->product_review_id = $productReview->id;
                $reviewGallery->image = $path;
                $reviewGallery->save();
            }
        }

        toastr('Success', 'success');

        return redirect()->back();

    }
}
