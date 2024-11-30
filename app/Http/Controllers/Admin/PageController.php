<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
  public function list()
  {
    $data['getRecord'] = PageModel::getRecord();
    $data['header_title'] = ' Page';
    return view('admin.page.list', $data);
  }
  public function edit($id)
  {
    $data['getRecord'] = PageModel::getSingle($id);
    $data['header_title'] = 'Edit Page';
    return view('admin.page.edit', $data);
  }

  public function update(Request $request, $id)
  {


    $page = PageModel::getSingle($id);
    $page->name = trim($request->name);
    $page->title = trim($request->title);
    $page->description = trim($request->description);
    $page->meta_title = trim($request->meta_title);
    $page->meta_description = trim($request->meta_description);
    $page->meta_keywords = trim($request->meta_keywords);

    $page->save();

    if (!empty($request->file('image'))) {


      $file = $request->file('image');
      $ext = $file->getClientOriginalExtension();
      $randomStr = $page->id . Str::random(20);
      $filename = strtolower($randomStr) . '.' . $ext;
      $file->move(public_path('upload/page/'), $filename);
      $page->image_name = trim($filename);
      $page->save();

    }



    return redirect('admin/page/list')->with('success', 'Page Succefully Updated');
  }

}
