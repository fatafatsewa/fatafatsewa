<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RepairRequest extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'contact_number', 'users_phone_id', 'phone_model', 'imei_number', 'phone_condition', 'phone_problems'];

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
            ->where('products.products_id', '=', $this->exchange_product_id)
            ->first();

        return $product;
    }

    public function getCustomerPhoneAttribute()
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
            ->where('products.products_id', '=', $this->users_phone_id)
            ->first();

        return $product;
    }
}
