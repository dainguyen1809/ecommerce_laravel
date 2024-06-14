<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:shipping_rules,name'],
            'type' => ['required',],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required',],
        ]);

        $shipping = new ShippingRule();
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_cost = $request->min_cost;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->save();

        toastr('Create Successfully!', 'success');
        return redirect()->route('admin.shipping-rule.index');
    }

    public function edit($id)
    {
        $shipping = ShippingRule::findOrFail($id);
        return view('admin.shipping-rule.edit', [
            'shipping' => $shipping,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:shipping_rules,name,' . $id],
            'type' => ['required',],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required',],
        ]);

        $shipping = ShippingRule::findOrFail($id);
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_cost = $request->min_cost;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->update();

        toastr('Update Successfully!', 'success');
        return redirect()->route('admin.shipping-rule.index');
    }

    public function changeStatus(Request $request)
    {
        $active = ShippingRule::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy($id)
    {
        $shipping = ShippingRule::findOrFail($id);
        $shipping->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete successfully!',
        ]);
    }
}
