@extends('web.layout')
@section('content')
  <!-- login Content -->
  <div class="container-fuild">
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">@lang('website.Home')</a></li>
          <li class="breadcrumb-item active" aria-current="page">@lang('website.Login')</li>

        </ol>
      </div>
    </nav>
  </div>

  <section class="page-area pro-content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 justify-content-center">
          @if (Session::has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="">@lang('website.Error'):</span>
              {!! session('loginError') !!}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="">@lang('website.success'):</span>
              {!! session('success') !!}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">@lang('website.Error'):</span>
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endforeach
          @endif

          @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">@lang('website.Error'):</span>
              {!! session('error') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">@lang('website.Success'):</span>
              {!! session('success') !!}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

        </div>
      </div>


      <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 fatafat-login--form">
          <div class="col-12 my-5 px-0">
            <form enctype="multipart/form-data" action="{{ URL::to('/process-login') }}" method="post">
              {{ csrf_field() }}
              <div class="from-group mb-3">
                <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Email')</label></div>
                <div class="input-group col-12">
                  <input type="email" name="email" id="email"
                    placeholder="@lang('website.Please enter your valid email address')"
                    class="form-control email-validate-login">
                  <span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
                </div>
              </div>
              <div class="from-group mb-3">
                <div class="col-12"> <label for="inlineFormInputGroup">@lang('website.Password')</label></div>
                <div class="input-group col-12">
                  <input type="password" name="password" id="password-login" placeholder="Please Enter Password"
                    class="form-control password-login">
                  <span class="help-block" hidden>@lang('website.This field is required')</span> </div>
              </div>
              <div class="col-12 col-sm-12">
                <button class="btn btn-secondary swipe-to-top">@lang('website.Login')</button>
                <a href="{{ URL::to('/otp-login') }}" class="btn btn-link">OTP Login</a>

                <a href="{{ URL::to('/forgotPassword') }}" class="btn btn-link">@lang('website.Forgot Password')</a>

                @if ($result['checkout_button'] == 1)
                  <p style="text-align:center; margin-top:30px;">
                    <strong>OR</strong>
                  </p>
                  <a href="{{ url('/guest_checkout') }}" type="submit" class="btn btn-light swipe-to-top btn-block">
                    @lang('website.Guest Checkout')
                  </a>
                @endif

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <style>
    .login--google {
      padding: 10px 11px;
      background: #e52e2e;
      border-radius: 100px;
      color: white;
      margin-right: 5px;
    }

    .login--facebook {
      padding: 10px 14px;
      background: #3c5a99;
      border-radius: 100px;
      color: white;
    }

  </style>

@endsection
