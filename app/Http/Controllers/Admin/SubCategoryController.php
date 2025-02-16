<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubCategoryModel::getRecord();
        $data['header_title'] = 'Sub Category';
        return view('admin.subcategory.list', $data);
    }
    public function add()
    {
        $data['getCategory'] = CategoryModel::getRecord(); // For fill dropdown list with category name
        $data['header_title'] = 'Add New Sub Category';
        return view('admin.subcategory.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category',
        ]);

        $subcategory = new SubCategoryModel();
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Sub Category Succefully Created');

    }
    public function edit($id)
    {
        $data['getCategory'] = CategoryModel::getRecord(); // For fill dropdown list with category name
        $data['getRecord'] = SubCategoryModel::getSingle($id);
        $data['header_title'] = 'Edit Sub Category';
        return view('admin.subcategory.edit', $data);
    }
    public function update(Request $request, $id)
    {

        request()->validate([
            'slug' => 'required|unique:sub_category,slug,' . $id,
        ]);

        $subcategory = SubCategoryModel::getSingle($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Sub Category Succefully Updated');
    }
    public function delete($id)
    {
        $category = SubCategoryModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect()->back()->with('success', 'Sub Category Succefully Deleted');
    }
    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;
        $get_sub_category = SubCategoryModel::getRecordSubCategory($category_id);
        $html = '';
        $html .= ' <option value="">Select</option>';
        foreach ($get_sub_category as $value) {
            $html .= ' <option value="' . $value->id . '">' . $value->name . '</option>';
        }
        $json['html'] = $html;
        return response()->json(['html' => $json]);
    }
}
