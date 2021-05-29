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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Lang;

class ExchangeController extends Controller
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

    // $product = DB::table('products')
    //   ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    //   ->select('products.products_id', 'products_description.products_name', 'products.products_price')
    //   ->get();



    $cat_id = $this->products->getCategoryIdWithChild(['slug' => 'mobile-phone']);

    $homecategorydata = array('page_number' => '0','type' => '', 'categories_id' => $cat_id, 'limit' => 10000, 'min_price' => null, 'max_price' => null);
    $product = $this->products->products($homecategorydata);
    $result['products'] = $product['product_data'];

    return view("web.exchange-apply", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }

  public function postExchange(Request $request)
  { 
    $citizenship_front = $this->moveFile($request->file('citizenship_front'));
    $citizenship_back = $this->moveFile($request->file('citizenship_back'));

    $data = [
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'contact_number' => $request->contact_number,
      'citizenship_front' => $citizenship_front,
      'citizenship_back' => $citizenship_back,
      'phone_model' => $request->phone_model,
      'imei_number' => $request->imei_number,
      'users_phone_id' => is_numeric($request->users_phone_id) ? $request->users_phone_id : 0,
      'purchased_at' => $request->purchased_at,
      'purchase_price' => $request->purchase_price,
      'phone_condition' => $request->phone_condition,
      'phone_problems' => ($request->has('phone_problems') && count($request->phone_problems)) ? implode(',', $request->phone_problems) : '',
      'exchange_product_id' => $request->exchange_product_id
    ];

    ExchangeRequest::create($data);
    return redirect()->back()->with('exchange_requested', true);
  }

  public function moveFile($file)
  {
    $fileName = Carbon::now()->timestamp . '-' . dechex(rand(1000, 100000)) . '.' . $file->getClientOriginalExtension();
    $path = $file->move(public_path('images/exchange-apply/citizenships'), $fileName);
    return url('/images/exchange-apply/citizenships/' . $fileName);
  }


  public function repair()
  {
    $final_theme = $this->theme->theme();
    $title = array('pageTitle' => Lang::get("website.Sign Up"));
    $result = array();
    $result['commonContent'] = $this->index->commonContent();

    $cat_id = $this->products->getCategoryIdWithChild(['slug' => 'mobile-phone']);

    $homecategorydata = array('page_number' => '0','type' => '', 'categories_id' => $cat_id, 'limit' => 10000, 'min_price' => null, 'max_price' => null);
    $product = $this->products->products($homecategorydata);
    // $product = DB::table('products')
    //   ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    //   ->select('products.products_id', 'products_description.products_name', 'products.products_price')
    //   ->get();

    $result['products'] = $product['product_data'];
    return view("web.repair-request", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }

  public function postRepair(Request $request)
  { 
    $data = [
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'contact_number' => $request->contact_number,
      'phone_model' => $request->phone_model,
      'imei_number' => $request->imei_number,
      'users_phone_id' => is_numeric($request->users_phone_id) ? $request->users_phone_id : 0,
      'phone_condition' => $request->phone_condition,
      'phone_problems' => ($request->has('phone_problems') && count($request->phone_problems)) ? implode(',', $request->phone_problems) : '',

    ];

    RepairRequest::create($data);
    return redirect()->back()->with('repair_requested', true);
  }
 }
