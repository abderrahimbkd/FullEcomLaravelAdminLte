<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingChargesController extends Controller
{
  public function list()
  {
    $data['getRecord'] = ShippingChargeModel::getRecord();
    $data['header_title'] = 'Shipping Charges';
    return view('admin.shippingcharges.list', $data);
  }
  public function add()
  {
    $data['header_title'] = 'Add New Shipping Charges';
    return view('admin.shippingcharges.add', $data);
  }
  public function insert(Request $request)
  {


    $DiscountCode = new ShippingChargeModel;
    $DiscountCode->name = trim($request->name);
    $DiscountCode->price = trim($request->price);
    $DiscountCode->status = trim($request->status);
    $DiscountCode->save();

    return redirect('admin/shipping_charges/list')->with('success', 'Shipping Charges Succefully Created');

  }
  public function edit($id)
  {
    $data['getRecord'] = ShippingChargeModel::getSingle($id);
    $data['header_title'] = 'Edit Shipping Charges';
    return view('admin.shippingcharges.edit', $data);
  }

  public function update(Request $request, $id)
  {
    $DiscountCode = ShippingChargeModel::getSingle($id);
    $DiscountCode->name = trim($request->name);
    $DiscountCode->price = trim($request->price);
    $DiscountCode->status = trim($request->status);
    $DiscountCode->save();

    return redirect('admin/shipping_charges/list')->with('success', 'Shipping Charges Succefully Updated');
  }

  public function delete($id)
  {
    $DiscountCode = ShippingChargeModel::getSingle($id);
    $DiscountCode->is_delete = 1;
    $DiscountCode->save();
    return redirect()->back()->with('success', 'Shipping Charges Succefully Deleted');
  }
}
