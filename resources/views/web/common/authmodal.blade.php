<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body auth--popup-body">
        <div class="row">
          <div class="col-sm-4 d-none d-sm-block login-modal-left">
            <div class="auth--content">
              <h1 style="font-size: 28px">Login</h1>
              <br><br>
              <p class="text-white" style="font-size: 16px">
                Get access to your Orders, Wishlist and Recommendations
              </p>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="auth--content">
              <form action="" class="website--login-form">
              <div class="error--area"></div>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="">Email Address / Username</label>
                  <input type="text" name="email" required class="form-control">
                </div>

                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" id="" class="form-control">
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-secondary login--button">Login</button>
                  <a href="/forgotPassword" class="btn btn-link">Forgot Password</a>
                </div>
              </form>

              <div class="text-center">
                <p>OR</p>
              </div>

              <div class="text-center">
                <button class="btn btn-light swipe-to-top trigger--otp-request" style="border: 1px solid gray">Request OTP</button>
              </div>
              <div class="registration-socials">
                <div class="row align-items-center justify-content-center">
                  <div class="col-12">
                    @lang('website.Access Your Account Through Your Social Networks')
                  </div>
                  <div class="col-12 right mt-3">
                    @if ($result['commonContent']['setting'][61]->value == 1)
                      <a href="login/google" class="login--google"><i class="fab sk fa-google" data-toggle="tooltip"
                          data-placement="bottom" title="@lang('website.google')"></i></a>
                      {{-- <a href="login/google" type="button" class="btn btn-google"><i
                          class="fab fa-google-plus-g"></i>&nbsp; @lang('website.Google') </a>
                      --}}
                    @endif
                    @if ($result['commonContent']['setting'][2]->value == 1)
                      <a href="login/facebook" class="login--facebook" data-toggle="tooltip" data-placement="bottom"
                        title="@lang('website.facebook')"><i class="fab fa-facebook-f"></i></a>
  
                      {{-- <a href="login/facebook" type="button"
                        class="btn btn-facebook"><i class="fab fa-facebook-f"></i>&nbsp;@lang('website.Facebook')</a>
                      --}}
                    @endif
  
                  </div>
                </div>
              </div>
              <div style="margin-top: 40px" class="text-center">
                <a href="javascript:void(0)" class="trigger--register">New to Fatafatsewa? Create an account</a>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="RegisterLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body auth--popup-body">
        <div class="row">
          <div class="col-sm-4 d-none d-sm-block login-modal-left">
            <div class="auth--content">
              <h1 style="font-size: 28px">Sign Up</h1>
              <br><br>
              <p class="text-white" style="font-size: 16px">
                Looks like you're new here!

                Sign up with your basic details to get started
              </p>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="auth--content">
              <form name="signup" enctype="multipart/form-data" class="form-validate website--register-form"  method="post">
                <div class="error--area"></div>
              {{ csrf_field() }}

              <div class="from-group mb-3 row">
                <div class="col-sm-6">
                    <input name="firstName" type="text" class="form-control field-validate" id="firstName"
                    placeholder="@lang('website.Please enter your first name')" value="{{ old('firstName') }}">
                    <span class="help-block text-danger error-firstName"></span>

                </div>
               
                <div class="col-sm-6">
                    <input name="lastName" type="text" class="form-control field-validate" id="lastname"
                    placeholder="@lang('website.Please enter your last name')" value="{{ old('lastName') }}">
                    <span class="help-block text-danger error-lastName"></span>
                  
                </div>
              </div>
              <div class="from-group mb-3">
                  <input name="email" type="text" class="form-control email-validate" id="inlineFormInputGroup"
                  placeholder="Enter Your Email or Username" value="{{ old('email') }}">
                  <span class="help-block text-danger error-email"></span>

                
              </div>

              <div class="form-group row">
                <div class="col-sm-6">
                <input type="password" class="form-control password" id="password" name="password"
                placeholder="Enter Your Password">
                  <span class="help-block text-danger error-password"></span>
              </span>
              </div>
              <div class="col-sm-6">
                <input type="password" class="form-control password" id="re_password" name="re_password"
                placeholder="Enter Your Password">
                <span class="help-block text-danger error-re_password"></span>

              </div>
            </div>
 
              <div class="from-group mb-3">
                  <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect" required>
                    <option selected value="">@lang('website.Choose...')</option>
                    <option value="0" @if (!empty(old('gender')) and old('gender') == 0) selected @endif
                      )>@lang('website.Male')</option>
                    <option value="1" @if (!empty(old('gender')) and old('gender') == 1) selected @endif
                      >@lang('website.Female')</option>
                  </select>
                  <span class="help-block" hidden>@lang('website.Please select your gender')</span>
              </div>
              <div class="from-group mb-3">
                  <input required style="margin:4px;"class="form-controlt checkbox-validate" type="checkbox">
                  @lang('website.Creating an account means you are okay with our')  @if(!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][3]->slug)}}"> @lang('website.Terms and Services')</a> @endif, @if(!empty($result['commonContent']['pages'][1]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][1]->slug)}}"> @lang('website.Privacy Policy')</a> @endif &nbsp; and &nbsp; @if(!empty($result['commonContent']['pages'][2]->slug))<a href="{{ URL::to('/page?name='.$result['commonContent']['pages'][2]->slug)}}"> @lang('website.Refund Policy')</a> @endif.
                  <span class="help-block" hidden>@lang('website.Please accept our terms and conditions')</span>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-secondary swipe-to-top register-button">@lang('website.Create an Account') </button>
                </div>
            </form>
          </div>

              <div class="text-center">
                <p>OR</p>
              </div>
              <div class="registration-socials">
                <div class="row align-items-center justify-content-center">
                  <div class="col-12">
                    @lang('website.Access Your Account Through Your Social Networks')
                  </div>
                  <div class="col-12 right mt-3">
                    @if ($result['commonContent']['setting'][61]->value == 1)
                      <a href="login/google" class="login--google"><i class="fab sk fa-google" data-toggle="tooltip"
                          data-placement="bottom" title="@lang('website.google')"></i></a>
  
                      {{-- <a href="login/google" type="button" class="btn btn-google"><i
                          class="fab fa-google-plus-g"></i>&nbsp; @lang('website.Google') </a>
                      --}}
                    @endif
                    @if ($result['commonContent']['setting'][2]->value == 1)
                      <a href="login/facebook" class="login--facebook" data-toggle="tooltip" data-placement="bottom"
                        title="@lang('website.facebook')"><i class="fab fa-facebook-f"></i></a>
  
                      {{-- <a href="login/facebook" type="button"
                        class="btn btn-facebook"><i class="fab fa-facebook-f"></i>&nbsp;@lang('website.Facebook')</a>
                      --}}
                    @endif
  
                  </div>
                </div>
              </div>
              <div style="margin-top:10px; margin-bottom:10px" class="text-center">
                <a href="javascript:void(0)" class="trigger--login">Existing user? Login here</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="requestOTP" tabindex="-1" role="dialog" aria-labelledby="requestOTPLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body auth--popup-body">
        <div class="row">
          <div class="col-sm-4 d-none d-sm-block login-modal-left">
            <div class="auth--content">
              <h1 style="font-size: 28px">Request OTP</h1>
              <br><br>
              <p class="text-white" style="font-size: 16px">
                Enter you mobile number to request One Time Password.
              </p>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="auth--content">
              <form action="" id="form-mobile--login">
                <div class="error--area"></div>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="">Mobile Number</label>
                  <input type="number" name="email"  id="mobile-login-phone" required class="form-control">
                </div>
 
                <div class="form-group">
                  <button type="submit" class="btn btn-secondary button-form-submit">Request OTP</button>
                </div>
              </form>

            
              <div class="registration-socials">
                <div class="row align-items-center justify-content-center">
                  <div class="col-12">
                    @lang('website.Access Your Account Through Your Social Networks')
                  </div>
                  <div class="col-12 right mt-3">
                    @if ($result['commonContent']['setting'][61]->value == 1)
                      <a href="login/google" class="login--google"><i class="fab sk fa-google" data-toggle="tooltip"
                          data-placement="bottom" title="@lang('website.google')"></i></a>
  
                      {{-- <a href="login/google" type="button" class="btn btn-google"><i
                          class="fab fa-google-plus-g"></i>&nbsp; @lang('website.Google') </a>
                      --}}
                    @endif
                    @if ($result['commonContent']['setting'][2]->value == 1)
                      <a href="login/facebook" class="login--facebook" data-toggle="tooltip" data-placement="bottom"
                        title="@lang('website.facebook')"><i class="fab fa-facebook-f"></i></a>
  
                      {{-- <a href="login/facebook" type="button"
                        class="btn btn-facebook"><i class="fab fa-facebook-f"></i>&nbsp;@lang('website.Facebook')</a>
                      --}}
                    @endif
  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="otpConfirmModal" tabindex="-1" role="dialog" aria-labelledby="requestOTPLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body auth--popup-body">
        <div class="row">
          <div class="col-sm-4 d-none d-sm-block login-modal-left">
            <div class="auth--content">
              <h1 style="font-size: 28px">Confirm OTP Code</h1>
              <br><br>
              <p class="text-white" style="font-size: 16px">
                Please enter the OTP you recieved on your number.
              </p>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="auth--content">
              <form action="" id="form-validate--otp">
              <div class="error--area"></div>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="">OTP</label>
                  <input type="text" name="otp"  id="otp-code" required class="form-control">
                  <span class="text-danger otp-error-section"></span>

                </div>
 
                <div class="form-group">
                  <button type="submit" class="btn btn-secondary validate-otp-button">Validate OTP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>