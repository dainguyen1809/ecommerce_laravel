<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

use function App\Helpers\active;

class BrandController extends Controller
{
    use UploadImage;
    private $model;
    public function __construct()
    {
        $this->model = new Brand();
    }
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $logoPath = $this->uploadImage($request, 'logo', 'images/brands');
        $brand = $this->model->fill($request->validated());
        $brand->logo = $logoPath;
        $brand->slug = str()->slug($request->name);
        $brand->save();

        toastr('Create Successfully', 'success');

        return redirect()->route('admin.brand.index');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = $this->model->findOrFail($id);
        $logoPath = $this->updateImage($request, 'logo', 'images/brands');
        $brand->fill($request->validated());
        $brand->logo = empty(! $logoPath) ? $logoPath : $brand->logo;
        $brand->save();

        toastr('Update Successfully', 'success');

        return redirect()->route('admin.brand.index');
    }

    public function changeStatus(Request $request)
    {
        active($request, $this->model->findOrFail($request->id));
    }

    public function destroy($id)
    {
        $brand = $this->model->findOrFail($id);
        $this->deleteImage($brand->logo);
        $brand->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully!',
        ]);
    }
}
