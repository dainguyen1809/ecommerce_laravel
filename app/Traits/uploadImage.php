<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait UploadImage
{
    public function uploadImage(Request $request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalName();
            $imgName = $inputName . '_' . uniqid() . '_' . $ext;
            $image->move(public_path($path), $imgName);
            // dd(public_path($path), $imgName);
            return $path . '/' . $imgName;
        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalName();
            $imgName = $inputName . '_' . uniqid() . '_' . $ext;
            $image->move(public_path($path), $imgName);
            // dd(public_path($path), $imgName);
            return $path . '/' . $imgName;
        }
    }

    public function deleteImage($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}