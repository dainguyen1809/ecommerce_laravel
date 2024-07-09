<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

use function App\Helpers\active;

class SubCategoryController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new SubCategory();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $sub_category = $this->model->fill($request->validated());
        $sub_category->category_id = $request->category;
        $sub_category->slug = str()->slug($request->name);
        $sub_category->save();

        toastr('Create successfully', 'success');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subCategory = $this->model->findOrFail($id);
        $categories = Category::all();
        return view('admin.sub-category.edit', [
            'subCategory' => $subCategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $subCategory = $this->model->findOrFail($id);
        $subCategory->fill($request->validated());
        $subCategory->slug = str()->slug($request->name);
        $subCategory->save();

        toastr('Upadted Successfully', 'success');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = $this->model->findOrFail($id);
        $childCategory = ChildCategory::where('category_id', $subCategory->id)->count();
        if ($childCategory > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This items contain sub items. Please delete sub items before deleting them!',
            ]);
        }
        $subCategory->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully!',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $active = $this->model->findOrFail($request->id);
        $active->status = $request->status == 'true' ? 1 : 0;
        $active->save();

        return response(['message' => 'Status has been updated!']);
    }

    // public function changeStatus(Request $request)
    // {
    //     $category = $this->model->findOrFail($request->id);
    //     $category->status = $request->status == 'true' ? 1 : 0;
    //     $category->save();

    //     return response()->json([
    //         'message' => 'Status has been updated!',
    //     ]);
    // }
}
