<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function viewCategory()
    {
        $categoryList = DB::select('select * from categories');
        return view('categoryList', ['categoryList' => $categoryList]);
    }

    public function addCategory()
    {
        $categoryList = DB::select('select * from categories');
        $categoryOption = DB::select('select * from categories');

        return view('formCategory', ['categoryList' => $categoryList, 'categoryOption' => $categoryOption]);
    }

    public function editCategory(Request $request, $id = null)
    {
        if ($id == null) {
            $category = new Category;
        } else {
            $customer = Category::find($id);
        }
        $category->parent_id = $request['parentCategory'];
        $category->category_name = $request['categoryName'];
        $category->is_active = $request['is_active'];
        $category->save();

        return redirect()->route('viewCategory');
    }
    // public function edit($id)
    // {
    //     $customer = Category::find($id);
    //     $data = compact('customer');
    //     return view('update_customer')->with($data);
    // }
    // public function destroy($id)
    // {
    //     //    echo $id;
    //     $customer = Customer::where('customer_id', $id)->delete();
    //     return redirect('customer/view');
    // }
}
