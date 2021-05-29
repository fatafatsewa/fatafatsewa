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