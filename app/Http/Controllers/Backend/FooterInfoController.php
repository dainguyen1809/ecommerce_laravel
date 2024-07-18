<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
    use UploadImage;
    public function index()
    {
        $footerInfo = FooterInfo::first();
        return view('admin.footer.footer-info.index', [
            'footerInfo' => $footerInfo,
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'logo' => ['nullable', 'image', 'max:3000'],
            'phone' => ['max:20'],
            'email' => ['max:255'],
            'address' => ['max:300'],
            'copyright' => ['max:255'],
        ]);

        $footerInfo = FooterInfo::find($id);
        $imgPath = $this->updateImage($request, 'logo', 'images/logo', $footerInfo?->logo);
        FooterInfo::updateOrCreate(
            ['id' => $id],
            [
                'logo' => empty(! $imgPath) ? $imgPath : $footerInfo?->banner,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright,
            ]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();
    }
}
