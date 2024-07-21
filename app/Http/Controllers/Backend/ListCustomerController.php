<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ListCustomerDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListCustomerController extends Controller
{
    public function index(ListCustomerDataTable $dataTable)
    {
        return $dataTable->render('admin.customer.index');
    }

    public function changeStatus(Request $request)
    {
        $active = User::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 'active' : 'block';

        $active->save();

        return response(['message' => 'Status has been updated!']);
    }
}
