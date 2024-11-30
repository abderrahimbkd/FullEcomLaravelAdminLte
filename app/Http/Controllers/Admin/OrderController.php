<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\OrderModel;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
  public function list()
  {
    $data['getRecord'] = OrderModel::getRecord();
    $data['header_title'] = 'Order';
    return view('admin.order.list', $data);
  }
  public function detail($id)
  {
    $data['getRecord'] = OrderModel::getSingle($id);
    $data['header_title'] = 'Orders Detail';
    return view('admin.order.detail', $data);
  }

  public function order_status(Request $request)
  {
    $getOrder = OrderModel::getSingle($request->order_id);
    $getOrder->status = $request->status;
    $getOrder->save();
    Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

    $json['message'] = 'Status Updated';
    echo json_encode($json);
  }




}
