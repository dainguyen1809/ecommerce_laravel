<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use UploadImage;
    private $model;
    public function __construct()
    {
        $this->model = new Slider();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
        // return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {

        $slider = $this->model;
        $imgPath = $this->uploadImage($request, 'banner', 'images/banners');
        $slider->fill($request->validated());
        $slider->banner = $imgPath; // Gán đường dẫn của tệp ảnh đã di chuyển vào trường 'banner'
        $slider->save();

        // dd($slider);
        toastr('Create Successfully', 'success');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', [
            'slider' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        $slider = $this->model->findOrFail($id);
        $imgPath = $this->updateImage($request, 'banner', 'images/banners', $slider->banner);
        $slider->fill($request->validated());
        $slider->banner = empty(! $imgPath) ? $imgPath : $slider->banner; // Gán đường dẫn của tệp ảnh đã di chuyển vào trường 'banner'
        // dd($slider->banner);
        $slider->save();

        toastr('Updated Successfully', 'success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = $this->model->findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully!',
        ]);
    }
}
