<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    public  function index(FooterGridThreeDataTable $dataTable){
        $title = FooterTitle::first();
        return $dataTable->render('admin.footer.footer-grid-three.index', [
            'title' => $title
        ]);
    }

    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>['required', 'max:255'],
            'url'=>['required', 'max:255'],
            'status'=>['required'],
        ]);

        $footer = new FooterGridThree();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toastr('Create Successfully', 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }

    public function edit($id){

        $footer = FooterGridThree::findOrFail($id);
        return view('admin.footer.footer-grid-three.edit', [
            'footer' => $footer,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>['required', 'max:255'],
            'url'=>['required', 'max:255'],
            'status'=>['required'],
        ]);

        $footer = FooterGridThree::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }

    public function destroy($id){
        $footer = FooterGridThree::findOrFail($id);
        $footer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $active = FooterGridThree::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;

        $active->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeTitle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:200']
        ]);

        FooterTitle::updateOrCreate(
            ['id' => 1],
            ['footer_grid_three_title' => $request->title]
        );

        toastr('Updated Successfully', 'success', 'success');

        return redirect()->back();
    }

//    public function changeTitle(Request $request)
//    {
//        $request->validate([
//            'title' => ['required', 'max:255'],
//        ]);
//
//        $title = FooterTitle::updateOrCreate(
//            ['id' => 1],
//            [
//                'footer_grid_three_title' => $request->title
//            ]
//        );
//
//    toastr('The title has been changed', 'success');
//
//    return redirect()->back();
//    }
}
