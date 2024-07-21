<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ListVendorDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListVendorController extends Controller
{
    public function index(ListVendorDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor.index');
    }

    public function changeStatus(Request $request)
    {
        $active = User::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 'active' : 'block';

        $active->save();

        return response(['message' => 'Status has been updated!']);
    }
}
