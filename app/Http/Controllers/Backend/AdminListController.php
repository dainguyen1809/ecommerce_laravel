<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $dataTable)
    {
        return $dataTable->render('admin.admin-list.index');
    }

    public function changeStatus(Request $request)
    {
        $active = User::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 'active' : 'block';

        $active->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        $products = Product::where('vendor_id', $admin->id)->get();
        if (count($products) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin can\'t be deleted. Please ban the user instead of delete!',
            ]);
        }
        Vendor::where('user_id', $admin->id)->delete();
        $admin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }
}
