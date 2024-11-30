<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class SliderController extends Controller
{
  public function list()
  {
    $data['getRecord'] = SliderModel::getRecord();
    $data['header_title'] = 'Slider';
    return view('admin.slider.list', $data);
  }
  public function add()
  {
    $data['header_title'] = 'Add New Slider';
    return view('admin.slider.add', $data);
  }
  public function insert(Request $request)
  {


    $slider = new SliderModel();

    $slider->title = trim($request->title);
    $slider->button_name = trim($request->button_name);
    $slider->button_link = trim($request->button_link);

    $file = $request->file('image_name');
    $ext = $file->getClientOriginalExtension();
    $randomStr = Str::random(20);
    $filename = strtolower($randomStr) . '.' . $ext;
    $file->move(public_path('upload/slider/'), $filename);
    $slider->image_name = trim($filename);
    $slider->status = trim($request->status);
    $slider->save();

    return redirect('admin/slider/list')->with('success', 'Slider Succefully Created');

  }
  public function edit($id)
  {
    $data['getRecord'] = SliderModel::getSingle($id);
    $data['header_title'] = 'Edit Shipping Charges';
    return view('admin.slider.edit', $data);
  }

  public function update(Request $request, $id)
  {
    $slider = SliderModel::getSingle($id);
    $slider->title = trim($request->title);
    $slider->button_name = trim($request->button_name);
    $slider->button_link = trim($request->button_link);
    if (!empty($request->file('image_name'))) {
      $file = $request->file('image_name');
      $ext = $file->getClientOriginalExtension();
      $randomStr = Str::random(20);
      $filename = strtolower($randomStr) . '.' . $ext;
      $file->move(public_path('upload/slider/'), $filename);
      $slider->image_name = trim($filename);
    }


    $slider->status = trim($request->status);
    $slider->save();

    return redirect('admin/slider/list')->with('success', 'Slider Succefully Updated');
  }

  public function delete($id)
  {
    $DiscountCode = SliderModel::getSingle($id);
    $DiscountCode->is_delete = 1;
    $DiscountCode->save();
    return redirect()->back()->with('success', 'Slider Succefully Deleted');
  }
}
