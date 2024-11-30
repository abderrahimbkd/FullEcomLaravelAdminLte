<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
  use HasFactory;
  protected $table = 'contact_us';


  public static function getRecord()
  {
    return self::select('contact_us.*')->orderBy('contact_us.id', 'desc')->paginate(20);
  }


  public static function getSingle($id)
  {
    return self::find($id);
  }
}
