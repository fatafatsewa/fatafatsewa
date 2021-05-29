<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
  protected $table = 'pre_orders';
  protected $fillable = ["full_name", "email", "contact_number", "city", "address", "municipality", "ward_no", "tole", "device_model", "ram", "storage", "color", "note"];
}
