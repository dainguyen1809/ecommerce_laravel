<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;

class FooterSocialController extends Controller
{
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('admin.footer.footer-socials.index');
    }

    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'link' => ['required', 'url', 'max:255'],
            'status' => ['required'],
        ]);

        $footerSocials = new FooterSocial();
        $footerSocials->icon = $request->icon;
        $footerSocials->name = $request->name;
        $footerSocials->link = $request->link;
        $footerSocials->status = $request->status;
        $footerSocials->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('admin.footer-socials.index');
    }

    public function edit($id)
    {
        $footerSocials = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-socials.edit', [
            'footerSocials' => $footerSocials,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'link' => ['required', 'url', 'max:255'],
            'status' => ['required'],
        ]);

        $footerSocials = FooterSocial::findOrFail($id);
        $footerSocials->icon = $request->icon;
        $footerSocials->name = $request->name;
        $footerSocials->link = $request->link;
        $footerSocials->status = $request->status;
        $footerSocials->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('admin.footer-socials.index');
    }

    public function destroy($id)
    {
        $footerSocials = FooterSocial::findOrFail($id);
        $footerSocials->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);

    }
    public function changeStatus(Request $request)
    {
        $active = FooterSocial::findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;

        $active->save();

        return response(['message' => 'Status has been updated!']);
    }
}
