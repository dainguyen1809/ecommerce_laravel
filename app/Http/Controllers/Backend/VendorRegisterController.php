<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRegisterDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRegisterController extends Controller
{
    public function index(VendorRegisterDataTable $dataTale)
    {
        return $dataTale->render('admin.vendor-register.index');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-register.show', compact('vendor'));
    }

    public function changeStatus(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user_id);
        $user->role = 'vendor';
        $user->save();

        toastr('Updated Successfully', 'success');
        return redirect()->route('admin.vendor-register.index');
    }
}
