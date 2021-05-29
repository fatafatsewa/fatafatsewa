<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AppliedEmi extends Model
{
  protected $table = 'applied_emi';
  protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'bank', 'emi_type', 'product_id', 'contact', 'address', 'gender', 'date_of_birth_bs', 'date_of_birth_ad', 'vehicle', 'residential_status', 'no_of_dependencies', 'occupation', 'monthly_income', 'employment_length', 'salary_certificate', 'citizenship', 'photo', 'has_card', 'emi_mode', 'down_payment', 'finance_amount', 'emi_per_month'];


  public function getProductDetailAttribute()
  {
      $product = DB::table('products')
          ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
          ->LeftJoin('image_categories', function ($join) {
              $join->on('image_categories.image_id', '=', 'products.products_image')
                  ->where(function ($query) {
                      $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                          ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                          ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                  });
          })
          ->where('products.products_id', '=', $this->product_id)
          ->first();

      return $product;
  }


  public function bank_(){
    return $this->belongsTo(Bank::class, 'bank');
  }
}
