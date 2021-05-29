<?php
namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller; 
//for password encryption or hash protected
use App\Models\Core\Languages; 
use App\Models\Core\Setting;
use DB;
use Illuminate\Http\Request;

//for authenitcate login data
use Lang;

//for requesting a value

class AdminHomecategoryController extends Controller
{

    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    //listingTaxClass
    public function all(Request $request)
    {
        $title = array('pageTitle' => 'Home Category');

        $result = array();
        $message = array();

        

        $banner = DB::table('home_category')
            ->leftJoin('languages', 'languages.languages_id', '=', 'home_category.languages_id') 
            ->select('home_category.*', 'languages.name as language_name');
            
          
            $banner->orderBy('home_category.homecategory_id', 'ASC')
            ->groupBy('home_category.homecategory_id');

        $banners = $banner->paginate(20);

        $result['message'] = $message;
        $result['homecategory'] = $banners;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.web.homecategory.index", $title)->with('result', $result);
    }

    //addTaxClass
    public function addhomecategory(Request $request)
    {
        $title = array('pageTitle' => 'Add Home Category');

        $result = array();
        $message = array();  

        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();
        

        $result['message'] = $message; 
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.homecategory.add", $title)->with(['result' => $result]);
    }

      public function addNewhomecategory(Request $request)
    {
 
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $expiryDate = str_replace('/', '-', $request->expires_date);
        $expiryDateFormate = date('Y-m-d H:i:s', strtotime($expiryDate));
        $type = $request->type;
  
        DB::table('home_category')->insert([
            'homecategory_title' => $request->homecategory_title,
            'homecategory_slug' => $request->homecategory_slug,
            'date_added' => date('Y-m-d H:i:s'),  
            'status' => $request->status, 
            'languages_id' => $request->languages_id,
        ]);

        $message = 'Home Category Added successfully';
        return redirect()->back()->withErrors([$message]);
    }


    //editTaxClass
    public function edithomecategory(Request $request)
    {
        $title = array('pageTitle' => 'Add Home Category');
        $result = array();
        $result['message'] = array();

        $banners = DB::table('home_category') 
            ->where('homecategory_id', $request->id)
            ->groupBy('home_category.homecategory_id')
            ->first();
        $result['home_category'] = $banners;

        //get function from other controller
        

        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter(); 
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin.settings.web.homecategory.edit', $title)->with(['result' => $result]);
    }

    public function updateHomecategory(Request $request)
    {
        $myVar = new Languages();
        $languages = $myVar->getter();
        
         DB::table('home_category')->where('homecategory_id', $request->id)->update([
            'homecategory_title' => $request->homecategory_title,
            'homecategory_slug' => $request->homecategory_slug,
            'date_status_change' => date('Y-m-d H:i:s'),  
            'status' => $request->status, 
            'languages_id' => $request->languages_id,
        ]);
        

        $message = 'Home Category Updated successfully';
        return redirect()->back()->withErrors([$message]);
    }

    //deleteCountry
    public function deleteHomecategory(Request $request)
    {
        DB::table('home_category')->where('homecategory_id', $request->homecategory_id)->delete();
        return redirect()->back()->withErrors(['Home Category Deleted successfully']);
    }
}
