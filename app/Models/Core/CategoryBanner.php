<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class CategoryBanner extends Model
{
 protected $table= 'categories_banners';
 protected $fillable = ['category_id', 'banner_image', 'link'];


  // public function getEmiFormFileAttribute() {
  //   return url('resources/assets/banks/' . $this->id .'/'. $this->emi_form);
  // }
}
