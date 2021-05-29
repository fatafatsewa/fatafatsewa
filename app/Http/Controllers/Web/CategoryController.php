<?php

namespace App\Http\Controllers\Web;

use App\Models\Core\Categories;
use App\Models\Core\CategoryBanner;
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

class CategoryController extends Controller
{


 public function __construct(
  Index $index,
  Languages $languages,
  Products $products,
  Currency $currency,
  Customer $customer,
  Categories $categories
 ) {
  $this->index = $index;
  $this->languages = $languages;
  $this->products = $products;
  $this->currencies = $currency;
  $this->customer = $customer;
  $this->theme = new ThemeController();
  $this->Categories = $categories;
 }


 public function getCategoryDetail($category_slug)
 {

  /**  MINIMUM PRICE **/
  if (!empty($request->min_price)) {
   $min_price = $request->min_price;
  } else {
   $min_price = '';
  }

  /**  MAXIMUM PRICE  **/
  if (!empty($request->max_price)) {
   $max_price = $request->max_price;
  } else {
   $max_price = '';
  }

  $final_theme = $this->theme->theme();
  $title = array('pageTitle' => Lang::get("website.Sign Up"));
  $result = array();
  $result['commonContent'] = $this->index->commonContent();

  $category = $this->Categories->getCategoriesByslug($category_slug);
  if (count($category)) {
   $category = $category[0];
   if (!$category->custom_dashboard) {
    abort(404);
   }

   $dash_categories = $this->Categories->getDashboardCategories($category->categories_id);

   foreach ($dash_categories as $dash_category) {
    $homecategorydata = array('page_number' => '0', 'type' => '', 'categories_id' => $dash_category->categories_id, 'limit' => 10, 'min_price' => $min_price, 'max_price' => $max_price, 'is_feature' => true);
    $products_ = $this->products->products($homecategorydata);
    // dd($products_);
    $dash_category->products = $products_;
   }

   $banners = CategoryBanner::where('category_id', $category->categories_id)->get();
   $result['banners'] = $banners;
   $result['dash_categories'] = $dash_categories;
   $result['category'] = $category;
   return view("web.category-detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
  }
  abort(404);
 }
}
