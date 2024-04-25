<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }
    public function show($id)
    {
        $category = Category::find($id);

        if (!empty($category)) {
            return response()->json($category, 200);
        } else {
            return response()->json(['message' => "Category Not Found"], 404);
        }
    }
    public function store(Request $request)
    {
        $category = new Category;
        $category->parent_id =  $request['parentCategory'];
        $category->category_name =  $request['categoryName'];
        $category->is_active = $request['is_active'];
        $category->save();
        return response()->json(['message' => "Category Added"], 201);
    }
    public function update(Request $request, $id)
    {
        if (Category::where('id', $id)->exists()) {

            $category = Category::find($id);
            $category->parent_id = is_null($request['parentCategory']) ? $category->parent_id : $request['parentCategory'];
            $category->category_name = is_null($request['categoryName']) ? $category->category_name : $request['categoryName'];
            $category->is_active = is_null($request['is_active']) ? $category->is_active : $request['is_active'];
            $category->save();
            return response()->json(['message' => "Category Updated"], 200);
        } else {
            return response()->json(['message' => "Category Not Found"], 404);
        }
    }
    // Deafult: soft delete
    public function destroy($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->is_active = 0;
            $category->save();
            return response()->json([
                "message" => "category deleted."
            ], 202);
        } else {
            return response()->json(['message' => 'category not found'], 404);
        }
    }
    // Hard Delete

    // public function destroy($id)
    // {
    //     if (Category::where('id', $id)->exists()) {
    //         $category = Category::find($id);
    //         $category->delete();
    //         return response()->json([
    //             "message" => "category deleted."
    //         ], 202);
    //     } else {
    //         return response()->json(['message' => 'category not found'], 404);
    //     }
    // }
}
