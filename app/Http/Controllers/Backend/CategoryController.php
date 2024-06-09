<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use function App\Helpers\active;

class CategoryController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Category();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->model->slug = str()->slug($request->name);

        $this->model
            ->fill($request->validated())
            ->save();
        toastr('Create Successfully!', 'success');
        return redirect()->route('admin.category.index');
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
        $category = $this->model->findOrFail($id);
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->model->findOrFail($id);
        $category->fill($request->validated());
        $category->slug = str()->slug($request->name);
        $category->save();
        // dd($category);

        toastr('Update Successfully!', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->model->findOrFail($id);
        $subCategory = SubCategory::where('category_id', $category->id)->count();
        if ($subCategory > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This items contain sub items. Please delete sub items before deleting them!',
            ]);
        }
        $category->delete();

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
