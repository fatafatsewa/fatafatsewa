<?php

namespace App\Http\Controllers\Web;

use App\ExchangeRequest;
use App\RepairRequest;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Customer;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\PreOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Lang;

class PreOrderController extends Controller
{
  public function __construct(
    Index $index,
    Languages $languages,
    Products $products,
    Currency $currency,
    Customer $customer,
    Cart $cart
  ) {
    $this->index = $index;
    $this->languages = $languages;
    $this->products = $products;
    $this->currencies = $currency;
    $this->customer = $customer;
    $this->cart = $cart;
    $this->theme = new ThemeController();
  }

  public function index()
  {
  
    $final_theme = $this->theme->theme();
    $title = array('pageTitle' => Lang::get("website.Sign Up"));
    $result = array();
    $result['commonContent'] = $this->index->commonContent();

    $product = DB::table('products')
      ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
      ->select('products.products_id', 'products_description.products_name', 'products.products_price')
      ->get();

    $result['products'] = $product;
    return view("web.preorder", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }

  public function postPreOrder(Request $request)
  { 
    $data =$request->all();
    PreOrder::create($data);
    return redirect()->back()->with('preorder_requested', true);

    // $data = [
    //   'first_name' => $request->first_name,
    //   'last_name' => $request->last_name,
    //   'email' => $request->email,
    //   'contact_number' => $request->contact_number,
    //   'citizenship_front' => $citizenship_front,
    //   'citizenship_back' => $citizenship_back,
    //   'phone_model' => $request->phone_model,
    //   'imei_number' => $request->imei_number,
    //   'users_phone_id' => is_numeric($request->users_phone_id) ? $request->users_phone_id : 0,
    //   'purchased_at' => $request->purchased_at,
    //   'purchase_price' => $request->purchase_price,
    //   'phone_condition' => $request->phone_condition,
    //   'phone_problems' => ($request->has('phone_problems') && count($request->phone_problems)) ? implode(',', $request->phone_problems) : '',
    //   'exchange_product_id' => $request->exchange_product_id
    // ];

    // ExchangeRequest::create($data);
  }
 }
