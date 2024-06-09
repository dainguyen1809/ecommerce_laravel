<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChildCategory\StoreChildCategoryRequest;
use App\Http\Requests\ChildCategory\UpdateChildCategoryRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function App\Helpers\active;

class ChildCategoryController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new ChildCategory();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create', [
            'categories' => $categories,
        ]);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)
            ->where('status', 1)->get(); //status active

        return $subCategories;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildCategoryRequest $request)
    {

        $child_category = $this->model->fill($request->validated());
        $child_category->category_id = $request->category;
        $child_category->sub_category_id = $request->sub_category;
        $child_category->slug = str()->slug($request->name);
        // dd($child_category);
        $child_category->save();

        toastr('Create Successfully!!', 'success');

        return redirect()->route('admin.child-category.index');
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
        $childCategory = $this->model->findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $childCategory->category_id)->get();

        // dd($subCategories);
        return view('admin.child-category.edit', [
            'childCategory' => $childCategory,
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildCategoryRequest $request, $id)
    {
        $childCateogry = $this->model->findOrFail($id);
        $childCateogry->fill($request->validated());
        $childCateogry->slug = str()->slug($request->name);
        $childCateogry->save();

        toastr('Update Successfully', 'success');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();

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
}
