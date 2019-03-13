<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
        app()->setLocale('ar');
    }

    public function index()
    {
        $categories = $this->repository->getAll();
        return view('backend.categories.index',compact('categories'));
    }

    public function edit(Category $category)
    {
        $parentCategories = $this->repository->getParentCategory();
        return view('backend.categories.edit',compact('category','parentCategories'));
    }

    public function update($category_id,Request $request)
    {

        $this->repository->update($category_id,$request->all());
        return redirect('admin/category');
    }
}
