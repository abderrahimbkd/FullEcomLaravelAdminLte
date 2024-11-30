<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingChargeModel extends Model
{
  use HasFactory;

  protected $table = 'shipping_charges';

  public static function getSingle($id)
  {
    return self::find($id);
  }
  public static function getRecord()
  {
    return self::select('shipping_charges.*')->where('shipping_charges.is_delete', '=', 0)->orderBy('shipping_charges.id', 'desc')->paginate(20);
  }
  public static function getRecordActive()
  {
    return self::select('shipping_charges.*')->where('shipping_charges.is_delete', '=', 0)->where('shipping_charges.status', '=', 0)->orderBy('shipping_charges.id', 'desc')->get();
  }


}