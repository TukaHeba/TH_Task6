<?php

namespace App\Http\Controllers\Api;

use App\Http\Trait\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return $this->customApi(CategoryResource::collection($categories), 'All available categories', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        $newCategory = Category::create([
            'name' => $request->name,
        ]);

        return $this->customApi(new CategoryResource($newCategory), 'Category created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->errorApi('Category does not exist', 404);
        }

        return $this->customApi(new CategoryResource($category), 'This is the category you want', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $request->validated();

        $updateCategory = Category::find($id);
        if (!$updateCategory) {
            return $this->errorApi('Category does not exist', 404);
        }
        $updateCategory->update([
            'name' => $request->name,
        ]);

        return $this->customApi(new CategoryResource($updateCategory), 'Category updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->errorApi('Category does not exist', 404);
        }
        $category->delete();

        return $this->customApi(new CategoryResource($category), 'Category deleted successfully', 200);
    }
}
