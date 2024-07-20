<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminProductReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminProductReviewController extends Controller
{
    public function index(AdminProductReviewsDataTable $dataTable)
    {
        return $dataTable->render('admin.review.index');
    }

    public function changeStatus(Request $request)
    {
        $active = ProductReview::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Status has been updated!']);
    }
}
