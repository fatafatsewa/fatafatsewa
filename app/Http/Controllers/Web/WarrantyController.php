<?php

namespace App\Http\Controllers\Web;

use App\Models\Web\Index;
use App\Models\Web\Products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Lang;

class WarrantyController extends Controller
{
  public function __construct(
    Index $index
  ) {
    $this->index = $index;
    $this->theme = new ThemeController();
  }

  public function index()
  {

    $title = array('pageTitle' => Lang::get("website.Contact Us"));
    $result = array();
    $final_theme = $this->theme->theme();
    $result['commonContent'] = $this->index->commonContent();
    return view('web.warranty-check', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }

  public function checkWarranty(Request $request) {
    $serial = $request->serial_number;
    $title = array('pageTitle' => "Check Warranty");
    $result = array();
    $final_theme = $this->theme->theme();
    $result['commonContent'] = $this->index->commonContent();
    // $order = DB::table('orders_products')->where('serial_number', $serial)->first();

    if($serial) {
    $orders_products = DB::table('orders_products')
    ->join('products', 'products.products_id', '=', 'orders_products.products_id')
    ->LeftJoin('image_categories', function ($join) {
        $join->on('image_categories.image_id', '=', 'products.products_image')
            ->where(function ($query) {
                $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                    ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                    ->orWhere('image_categories.image_type', '=', 'ACTUAL');
            });
    })
    ->select('orders_products.*', 'image_categories.path as image')
    ->where('orders_products.serial_number', '=', $serial)->first();
    
    if($orders_products){
      $order_detail = DB::table('orders')->where('orders_id', $orders_products->orders_id)->first();
      $warrenty_detail = DB::table('products')->where('products_id', $orders_products->products_id)->select('warrenty')->first();
      $order_product_detail = json_decode(json_encode($orders_products), true);
      $order_product_detail['warranty'] = $warrenty_detail->warrenty;
      $result['order_detail'] = $order_detail;
      return view('web.warranty-check', ['title' => $title, 'final_theme' => $final_theme, 'found' => true, 'params' => $request->all(), 'order_product_detail' => $order_product_detail])->with('result', $result);
    }
    return view('web.warranty-check', ['title' => $title, 'final_theme' => $final_theme, 'found' => false, 'params' => $request->all()])->with('result', $result);
  }else{
    return view('web.warranty-check', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }
  }
}
