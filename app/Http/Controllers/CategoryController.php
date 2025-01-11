<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function viewCategory()
    {
        // Check if the category list exists in the cache
        // if (Cache::has('categoryList')) {
        //     // If it does, retrieve it from the cache
        //     $categoryList = Cache::get('categoryList');
        // } else {
        // If it doesn't, fetch it from the database and store it in the cache
        $categoryList = DB::select('select * from categories where is_active = ? or is_active = ?', [1, 0]);
        //     Cache::put('categoryList', $categoryList, now()->addMinutes(1)); // Cache for 1 minutes
        // }

        // Return the category list to the view
        // return view('categoryList', ['categoryList' => $categoryList]);
        return view('category', ['categoryList' => $categoryList]);
    }

    public function newCategoryForm()
    {
        $categoryOption = DB::select('select * from categories where is_active = ? ', [1]);

        // return view('formCategory', ['categoryList' => $categoryOption]);
        return view('categoryEdit', ['categoryList' => $categoryOption]);

    }

    public function addCategory(Request $request)
    {

        $category = new Category;
        $category->parent_id = $request['parentCategory'];
        $category->category_name = $request['categoryName'];
        $category->is_active = $request['is_active'];
        $category->save();

        return redirect()->route('viewCategory');
    }

    public function editCategory(Request $request, $id)
    {
        $currentCategory = Category::find($id);
        $categoryOption = DB::select('select * from categories');

        // return view('formCategoryUpdate', ['categoryList' => $categoryOption, 'currentCategory' => $currentCategory]);
        return view('categoryEdit', ['categoryList' => $categoryOption, 'currentCategory' => $currentCategory]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->parent_id = $request['parentCategory'];
        $category->category_name = $request['categoryName'];
        $category->is_active = $request['is_active'];
        $category->save();

        return redirect()->route('viewCategory');
    }

    public function deleteCategory($id)
    {
        // "is_active" logic 1 = active , 0 = deactive & 9= delete
        $category = Category::find($id);
        $category->is_active = 9;
        $category->save();

        return redirect()->route('viewCategory');
    }
}
