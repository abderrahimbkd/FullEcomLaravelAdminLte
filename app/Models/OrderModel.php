<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public static function getSingle($id)
    {
        return self::find($id);
    }

    //User part
    public static function getTotalOrderUser($user_id)
    {
        return self::select('id')->where('user_id', '=', $user_id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->count();

    }
    public static function getTodayTotalOrderUser($user_id)
    {
        return self::select('id')->where('user_id', '=', $user_id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '=', date('Y-m-d'))->count();

    }
    public static function getTotalAmountUser($user_id)
    {
        return self::select('id')->where('user_id', '=', $user_id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->sum('total_amount');

    }
    public static function getTotalTodayAmountUser($user_id)
    {
        return self::select('id')->where('user_id', '=', $user_id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '=', date('Y-m-d'))->sum('total_amount');

    }

    public static function getTotalStatusUser($user_id, $status)
    {
        return self::select('id')->where('user_id', '=', $user_id)->where('status', '=', $status)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->count();

    }
    //end user part

    public static function getTotalOrder()
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->count();

    }
    public static function getTodayTotalOrder()
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '=', date('Y-m-d'))->count();

    }
    public static function getTotalOrderMounth($start_date, $end_date)
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();

    }
    public static function getTotalOrderAmountMounth($start_date, $end_date)
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('total_amount');

    }
    public static function getTotalAmount()
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->sum('total_amount');

    }
    public static function getTotalTodayAmount()
    {
        return self::select('id')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->whereDate('created_at', '=', date('Y-m-d'))->sum('total_amount');

    }
    public static function getLatestOrders()
    {
        return OrderModel::select('orders.*')->where('is_payment', '=', 1)->where('is_delete', '=', 0)->orderBy('id', 'desc')->limit(10)->get();

    }
    public static function getRecordUser($user_id)
    {
        return OrderModel::select('orders.*')->where('user_id', '=', $user_id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->orderBy('id', 'desc')->paginate(30);
    }
    public static function getSingleUser($user_id, $id)
    {
        return OrderModel::select('orders.*')->where('user_id', '=', $user_id)->where('id', '=', $id)->where('is_payment', '=', 1)->where('is_delete', '=', 0)->orderBy('id', 'desc')->first();
    }
    public static function getRecord()
    {
        $return = OrderModel::select('orders.*');
        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('company_name'))) {
            $return = $return->where('company_name', 'like', '%' . Request::get('company_name') . '%');
        }
        if (!empty(Request::get('first_name'))) {
            $return = $return->where('first_name', 'like', '%' . Request::get('first_name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('phone'))) {
            $return = $return->where('phone', 'like', '%' . Request::get('phone') . '%');
        }

        if (!empty(Request::get('post_code'))) {
            $return = $return->where('post_code', 'like', '%' . Request::get('post_code') . '%');
        }
        if (!empty(Request::get('country'))) {
            $return = $return->where('country', 'like', '%' . Request::get('country') . '%');
        }
        if (!empty(Request::get('state'))) {
            $return = $return->where('state', 'like', '%' . Request::get('state') . '%');
        }
        if (!empty(Request::get('city'))) {
            $return = $return->where('city', 'like', '%' . Request::get('city') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $return = $return->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $return = $return->whereDate('created_at', '<=', Request::get('to_date'));
        }



        $return = $return->where('is_payment', '=', 1)->where('is_delete', '=', 0)->orderBy('id', 'desc')->paginate(30);
        return $return;
    }
    public function getShipping()
    {
        return $this->belongsTo(ShippingChargeModel::class, 'shipping_id');
    }
    public function getItem()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }
  

}
