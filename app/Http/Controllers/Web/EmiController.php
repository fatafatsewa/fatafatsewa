<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Core\AppliedEmi;
use App\Models\Core\Bank;
use Illuminate\Http\Request;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Customer;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmiController extends Controller
{
  public function __construct(
    Index $index,
    Languages $languages,
    Products $products,
    Currency $currency,
    Customer $customer,
    Cart $cart,
    AlertController $alert
  ) {
    $this->index = $index;
    $this->languages = $languages;
    $this->products = $products;
    $this->currencies = $currency;
    $this->customer = $customer;
    $this->cart = $cart;
    $this->theme = new ThemeController();

    $this->alert = $alert;
  }
  public function applyEmi(Request $request)
  {
    // return $request->all();
    // $this->validate($request, [
    //   'full_name' => 'required',
    //   'email' => "required|email",
    //   'bank' => 'required',
    //   'emi_type' => 'required'
    // ]);
    // protected $fillable = ["monthly_income", "employment_length", "salary_certificate", "citizenship", "photo"];

    $salary_certificate = '';
    if ($request->file('salary_certificate'))
      $salary_certificate = $this->moveFile($request->file('salary_certificate'));

    $citizenship = '';
    if ($request->file('citizenship'))
      $citizenship = $this->moveFile($request->file('citizenship'));

    $photo = '';
    if ($request->file('photo'))
      $photo = $this->moveFile($request->file('photo'));

    $emi = AppliedEmi::create([
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_nmae,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'bank' => $request->bank,
      'product_id' => $request->product_id,
      'contact' => $request->contact,
      'address' => $request->address,
      'gender' => $request->gender,
      'date_of_birth_bs' => $request->date_of_birth_bs,
      'date_of_birth_ad' => $request->date_of_birth_ad,
      'vehicle' => $request->vehicle,
      'residential_status' => $request->residential_status,
      'no_of_dependencies' => $request->no_of_dependencies,
      'occupation' => $request->occupation,
      'monthly_income' => $request->monthly_income,
      'salary_certificate' => $salary_certificate,
      'citizenship' => $citizenship,
      'photo' => $photo,
      'has_card' => $request->has_card,
      'emi_mode' => $request->emi_mode,
      'down_payment' => $request->down_payment,
      'finance_amount' => $request->finance_amount,
      'emi_per_month' => $request->emi_per_month
    ]);

    $data = [];
    $bank = Bank::find($request->bank);
    // $product = Products::where('products_id', $request->product_id)->first();

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
    ->where('products.products_id', '=', $request->product_id)
    ->first();

    $data['bank'] = $bank;
    $data['product'] = $product;
    $data['emiData'] = $emi;
    $this->alert->emiAlert($data);

    return redirect()->back()->with(['emi_applied' => true, 'emi_data' => $data]);

    // return response()->json(['success' => true, 'message' => "Thank you for applying EMI. We will get back to you soon."]);
  }


  public function validateEmiForm(Request $request)
  {
    $this->validate($request, [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required',
      'contact' => 'required',
      'address' => 'required',
      'gender' => 'required',
      'date_of_birth_ad' => 'required',
      'date_of_birth_bs' => 'required',
      'has_card' => 'required|not_in:0',
      'bank' => 'required',
      'emi_mode' => 'required',
      'down_payment' => 'required',
      'emi_per_month' => 'required'

    ]);

    if ($request->has_card === '1' || $request->has_card === 1) {
      // $this->validate($request, [
      // ]);
    } else {
      $this->validate($request, [
        'vehicle' => 'required',
        'residential_status' => 'required',
        'no_of_dependencies' => 'required',
        'occupation' => 'required',
        'monthly_income' => 'required',
        'employment_length' => 'required',
        'salary_certificate' => 'required',
        'citizenship' => 'required',
        'photo' => 'required',
       
      ]);
    }

    return response()->json(['success' => true]);
  }

  public function emiProducts(Request $request)
  {
    $final_theme = $this->theme->theme();
    $title = array('pageTitle' => "EMI Products");
    $result = array();
    $result['commonContent'] = $this->index->commonContent();

    // $product = DB::table('products')
    //   ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
    //   // ->select('products.products_id', 'products_description.products_name', 'products.products_price')
    //   ->where('products.emi_enabled', 1)
    //   ->get();
    if (!empty($request->page)) {
      $page_number = $request->page;
    } else {
      $page_number = 0;
    }

    if (!empty($request->limit)) {
      $limit = $request->limit;
    } else {
      $limit = 15;
    }

    if (!empty($request->type)) {
      $type = $request->type;
    } else {
      $type = '';
    }

    //min_max_price
    if (!empty($request->price)) {
      $d = explode(";", $request->price);
      $min_price = $d[0];
      $max_price = $d[1];
    } else {
      $min_price = '';
      $max_price = '';
    }
    $data = [
      'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
      'min_price' => $min_price, 'max_price' => $max_price,
      'emi_enabled' => true
    ];
    $products = $this->products->products($data);


    $result['products'] = $products;
    return view('web.emi-products', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }


  public function moveFile($file)
  {
    $fileName = Carbon::now()->timestamp . '-' . dechex(rand(1000, 100000)) . '.' . $file->getClientOriginalExtension();
    $path = $file->move(public_path('images/emi-applications/files'), $fileName);
    return url('/images/emi-applications/files/' . $fileName);
  }
}
