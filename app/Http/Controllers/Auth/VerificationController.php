<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ThemeController;
use App\Models\Web\Index;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Index $index)
    {
        // $this->middleware('Customer');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->theme = new ThemeController();
        $this->index = $index;

    }

    public function redirectPath()
    {
       return '/';
    }

    public function show(Request $request)
    {

        $title = array('pageTitle' => Lang::get("website.Forgot Password"));
        $final_theme = $this->theme->theme();
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        return auth()->guard('customer')->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.verify', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    public function resend(Request $request)
    {
        if (auth()->guard('customer')->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
 
        auth()->guard('customer')->user()->sendEmailVerificationNotification();
 
        return back()->with('resent', true);
    }
}
