<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\AlertController;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Customer;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\RewardPointLog;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Session;
use Socialite;
use Validator;
use Hash;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class CustomersController extends Controller
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

    public function verifyEmail(Request $request) {
        $customer = auth()->guard('customer')->loginUsingId($request->route('id')); 
        
        
        if (! hash_equals((string) $request->route('id'), (string) $customer->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($customer->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($customer->hasVerifiedEmail()) {
            return redirect('/');
        }

        if ($customer->markEmailAsVerified()) {
            event(new Verified($request->user()));

            $refered_by = DB::table('users')->where('id', $customer->referred_by)->first();
            if ($refered_by) {
                $refered_by_ = $refered_by->id;
                $points = DB::table('settings')->where('name', 'referral_points')->first()->value;
                DB::table('users')->where('id', $refered_by->id)->update([
                    'reward_points' => $refered_by->reward_points + $points
                ]);
    
                 //REWARD LOG
                 RewardPointLog::create([
                    'user_id' => $refered_by->id,
                    'action' => '+',
                    'points' => $points,
                    'remarks' => $points.' points added (Referred '.$customer->first_name.' '.$customer->last_name.')'
                ]);
            }
                
        }

        return redirect('/')->with('verified', true);
    }

    public function signup(Request $request)
    {
        $final_theme = $this->theme->theme();
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {
            $title = array('pageTitle' => Lang::get("website.Sign Up"));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function login(Request $request)
    {
        $result = array();
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {
            $result['cart'] = $this->cart->myCart($result);

            if (count($result['cart']) != 0) {
                $result['checkout_button'] = 1;
            } else {
                $result['checkout_button'] = 0;
            }
            $previous_url = Session::get('_previous.url');

            $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            $ref = rtrim($ref, '/');

            session(['previous' => $previous_url]);

            $title = array('pageTitle' => Lang::get("website.Login"));
            $final_theme = $this->theme->theme();

            $result['commonContent'] = $this->index->commonContent();
            return view("auth.login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function processLogin(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL ) 
        ? 'email' 
        : 'user_name';


    $request->merge([
        $login_type => $request->email
    ]);

        //check authentication of email and password
        $customerInfo = $request->only($login_type, 'password');
        if (auth()->guard('customer')->attempt($customerInfo)) {
            $customer = auth()->guard('customer')->user();

            // if(!$customer->hasVerifiedEmail()) {
            //     return response()->json(['success' => false, 'message' => 'Email is not verified yet. ']);
            // }
            if ($customer->role_id != 2) {
                $record = DB::table('settings')->where('id', 94)->first();
                if ($record->value == 'Maintenance' && $customer->role_id == 1) {
                    auth()->attempt($customerInfo);
                } else {
                    Auth::guard('customer')->logout();
                    return response()->json(['success' => false, 'message' => Lang::get("website.You Are Not Allowed With These Credentials!")]);

                    // return redirect('login')->with('loginError', Lang::get("website.You Are Not Allowed With These Credentials!"));
                }
            }
            $result = $this->customer->processLogin($request, $old_session);
            if (!empty(session('previous'))) {
                return response()->json(['success' => true]);

                // return Redirect::to(session('previous'));
            } else {

                Session::forget('guest_checkout');
                return response()->json(['success' => true]);
                // return redirect()->intended('/')->with('result', $result);
            }
        } else {
            return response()->json(['success' => false]);
            return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
        }
        //}
    }

    public function addToCompare(Request $request)
    {
        $cartResponse = $this->customer->addToCompare($request);
        return $cartResponse;
    }

    public function DeleteCompare($id)
    {
        $Response = $this->customer->DeleteCompare($id);
        return redirect()->back()->with($Response);
    }

    public function Compare()
    {
        $result = array();
        $final_theme = $this->theme->theme();
        $result['commonContent'] = $this->index->commonContent();
        $compare = $this->customer->Compare();
        $results = array();
        foreach ($compare as $com) {
            $data = array('products_id' => $com->product_ids, 'page_number' => '0', 'type' => 'compare', 'limit' => '15', 'min_price' => '', 'max_price' => '');
            $newest_products = $this->products->products($data);
            array_push($results, $newest_products);
        }
        $result['products'] = $results;
        return view('web.compare', ['result' => $result, 'final_theme' => $final_theme]);
    }

    public function profile()
    {
        $title = array('pageTitle' => Lang::get("website.Profile"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        return view('web.profile', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme]);
    }

    public function updateMyProfile(Request $request)
    {
        $message = $this->customer->updateMyProfile($request);
        return redirect()->back()->with('success', $message);
    }

    public function changePassword()
    {
        $title = array('pageTitle' => Lang::get("website.Change Password"));
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        return view('web.changepassword', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme]);
    }


    public function referFriends()
    {
        $title = array('pageTitle' => "Refer Friends");
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        return view('web.referfriends', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme]);
    }

    public function generateReferralCode()
    {
        $referral_code = $this->generateRandomString(10);
        $customers_id = auth()->guard('customer')->user()->id;

        DB::table('users')->where('id', $customers_id)->update([
            'referral_code' => $referral_code
        ]);
        return redirect()->back();
    }

    public  function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function updateMyPassword(Request $request)
    {
        $password = Auth::guard('customer')->user()->password;
        if (Hash::check($request->current_password, $password)) {
            $message = $this->customer->updateMyPassword($request);
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', lang::get("website.Current password is invalid"));
        }
    }

    public function logout(REQUEST $request)
    {
        Auth::guard('customer')->logout();
        session()->flush();
        $request->session()->forget('customers_id');
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleSocialLoginCallback($social)
    {
        $result = $this->customer->handleSocialLoginCallback($social);
        if (!empty($result)) {
            return redirect()->intended('/')->with('result', $result);
        }
    }

    public function createRandomPassword()
    {
        $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        return $pass;
    }

    public function likeMyProduct(Request $request)
    {
        $cartResponse = $this->customer->likeMyProduct($request);
        return $cartResponse;
    }

    public function unlikeMyProduct(Request $request, $id)
    {

        if (!empty(auth()->guard('customer')->user()->id)) {
            $this->customer->unlikeMyProduct($id);
            $message = Lang::get("website.Product is unliked");
            return redirect()->back()->with('success', $message);
        } else {
            return redirect('login')->with('loginError', 'Please login to like product!');
        }
    }

    public function wishlist(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Wishlist"));
        $final_theme = $this->theme->theme();
        $result = $this->customer->wishlist($request);
        return view("web.wishlist", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function loadMoreWishlist(Request $request)
    {

        $limit = $request->limit;

        $data = array('page_number' => $request->page_number, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $myVar = new CartController();
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        return view("web.wishlistproducts")->with('result', $result);
    }

    public function forgotPassword()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {

            $title = array('pageTitle' => Lang::get("website.Forgot Password"));
            $final_theme = $this->theme->theme();
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            return view("web.forgotpassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function processPassword(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));

        $password = $this->createRandomPassword();

        $email = $request->email;
        $postData = array();

        //check email exist
        $existUser = $this->customer->ExistUser($email);
        if (count($existUser) > 0) {
            $this->customer->UpdateExistUser($email, $password);
            $existUser[0]->password = $password;

            $myVar = new AlertController();
            $alertSetting = $myVar->forgotPasswordAlert($existUser);

            return redirect('login')->with('success', Lang::get("website.Password has been sent to your email address"));
        } else {
            return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
        }
    }

    public function recoverPassword()
    {
        $title = array('pageTitle' => Lang::get("website.Forgot Password"));
        $final_theme = $this->theme->theme();
        return view("web.recoverPassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function subscribeNotification(Request $request)
    {

        $setting = $this->index->commonContent();

        /* Desktop */
        $type = 3;

        session(['device_id' => $request->device_id]);

        if (auth()->guard('customer')->check()) {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'created_at' => time(),
                'updated_at' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'user_id' => auth()->guard('customers')->user()->id,
                'manufacturer' => '',
            );
        } else {

            $device_data = array(
                'device_id' => $request->device_id,
                'device_type' => $type,
                'created_at' => time(),
                'updated_at' => time(),
                'ram' => '',
                'status' => '1',
                'processor' => '',
                'device_os' => '',
                'location' => '',
                'device_model' => '',
                'manufacturer' => '',
            );
        }
        $this->customer->updateDevice($request, $device_data);
        print 'success';
    }


    public function ajaxSignupProcess(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required ',
            'lastName' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'password' => 'required',
            're_password' => 'required | same:password',
        ]);

        
        $user_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($user_type === 'email') {
            $this->validate($request, [
                'email' => 'unique:users,email'
            ]);
        } else {
            $this->validate($request, [
                'email' => 'unique:users,user_name'
            ], [
                'email.unique' => 'User name is already taken.'
            ]);
        }
        $res = $this->customer->signupProcess($request);
        //eheck email already exit

        if ($res['insert'] == "true") {
            if ($res['auth'] == "true") {
                // $result = $res['result'];
                Session::forget('guest_checkout');
                return response()->json(['success' => true]);
                // return redirect()->intended('/')->with('result', $result);
            } 
            else if($res['verfication'] == "true") {
                Auth::guard('customer')->logout();
                return response()->json(['success' => false, 'message' => "We've sent you an email verification link. Please verify your email to proceed."]);
            }
            else {
                return response()->json(['success' => false]);
                // return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
            }
        } else {
            return response()->json(['success' => false]);

            // return redirect('/login')->with('error', Lang::get("website.something is wrong"));
        }
    }


    public function otpLoginProcess(Request $request)
    {
        $user = DB::table('users')->where([
            'phone' => $request->phone_number
        ])->first();

        if (!$user) {
            DB::table('users')->insert([
                'phone' => $request->phone_number
            ]);
        }
        $user = DB::table('users')->where([
            'phone' => $request->phone_number
        ])->first();
        $old_session = Session::getId();
        if (auth()->guard('customer')->loginUsingId($user->id, true)) {
            $customer = auth()->guard('customer')->user();
            //set session
            session(['customers_id' => $customer->id]);

            //cart
            $cart = DB::table('customers_basket')->where([
                ['session_id', '=', $old_session],
            ])->get();

            if (count($cart) > 0) {
                foreach ($cart as $cart_data) {
                    $exist = DB::table('customers_basket')->where([
                        ['customers_id', '=', $customer->id],
                        ['products_id', '=', $cart_data->products_id],
                        ['is_order', '=', '0'],
                    ])->delete();
                }
            }

            DB::table('customers_basket')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            DB::table('customers_basket_attributes')->where('session_id', '=', $old_session)->update([
                'customers_id' => $customer->id,
            ]);

            //insert device id
            if (!empty(session('device_id'))) {
                DB::table('devices')->where('device_id', session('device_id'))->update(['user_id' => $customer->id]);
            }

            $result['customers'] = DB::table('users')->where('id', $customer->id)->get();

            return response()->json(['success' => true]);
        }
    }
    public function signupProcess(Request $request)
    {
        $old_session = Session::getId();

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $gender = $request->gender;
        $email = $request->email;
        $password = $request->password;
        $date = date('y-md h:i:s');
        //        //validation start
        $validator = Validator::make(
            array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'customers_gender' => $request->gender,
                'email' => $request->email,
                'password' => $request->password,
                're_password' => $request->re_password,

            ),
            array(
                'firstName' => 'required ',
                'lastName' => 'required',
                'customers_gender' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                're_password' => 'required | same:password',
            )
        );
        $refered_by_ = null;
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->has('referral_code')) {
                $refered_by = DB::table('users')->where('referral_code', $request->get('referral_code'))->first();
                if ($refered_by) {
                    $refered_by_ = $refered_by->id;
                    // $points = DB::table('settings')->where('name', 'referral_points')->first()->value;
                    // DB::table('users')->where('id', $refered_by->id)->update([
                    //     'reward_points' => $refered_by->reward_points + $points
                    // ]);
                } else {
                    return redirect()->back()->with('error', "Invalid referral code.");
                }
            }
            $res = $this->customer->signupProcess($request, $refered_by_);
            //eheck email already exit
            if ($res['email'] == "true") {
                return redirect('/login')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
            } else {
                if ($res['insert'] == "true") {
                    if ($res['auth'] == "true") {
                        $result = $res['result'];
                        Session::forget('guest_checkout');
                        return redirect()->intended('/')->with('result', $result);
                    } else {
                        return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
                    }
                } else {
                    return redirect('/login')->with('error', Lang::get("website.something is wrong"));
                }
            }
        }
    }

    public function referAndEarn($referral)
    {
        $user = DB::table('users')->where('referral_code', $referral)->first();

        if(!$user) {
            abort(404);
        }
        $final_theme = $this->theme->theme();
        if (auth()->guard('customer')->check()) {
            return redirect('/');
        } else {
            $title = array('pageTitle' => Lang::get("website.Sign Up"));
            $result = array();
            $result['commonContent'] = $this->index->commonContent();
            $result['referral'] = $referral;
            return view("web.refer-n-earn", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        }
    }

    public function sendOTP(Request $request)
    {
        $otp = rand(100000, 999999);


        $args = http_build_query(array(
            'token' => 'u8xtsRZ6I41XHI0QRQQD',
            'from'  => 'Demo',
            'to'    => $request->phone_number,
            'text'  => 'Your OTP code to login to fatafatsewa is ' . $otp
        ));

        $url = "http://api.sparrowsms.com/v2/sms/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code === 400) {
            $response = json_decode($response);
            return response()->json(['success' => false, 'message' => "Invalid phone number"]);
        }

        session()->put('my_otp', $otp);
        return response()->json(['success' => true, 'otp' => $otp]);
    }

    public function validateOTP(Request $request)
    {
        $correct_otp = session()->get('my_otp');
        if ($correct_otp === (int)$request->otp) {
            return response()->json(['validated' => true]);
        }

        return response()->json(['validated' => false]);
    }
}
