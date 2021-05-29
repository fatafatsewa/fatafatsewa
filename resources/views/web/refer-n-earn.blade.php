@extends('web.layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="registration-form" style="width: 700px; margin:auto; margin-top:30px">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">@lang('website.Error'):</span>
          {!! session('error') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if($errors->any())
      {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
     @endif
      {{-- {{ dd($errors)}} --}}
      <form name="signup" enctype="multipart/form-data"   action="{{ URL::to('/signupProcess') }}"
        method="post">
        {{ csrf_field() }}
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>@lang('website.First Name')</label></div>
          <div class="input-group col-12">
            <input name="firstName" type="text" class="form-control field-validate" id="firstName" required
              placeholder="Enter your first name" value="{{ old('firstName') }}">
            <span class="help-block" hidden>@lang('website.Please enter your first name')</span>
          </div>
        </div>
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong>Last Name</label></div>
          <div class="input-group col-12">
            <input name="lastName" type="text" class="form-control field-validate field-validate" id="lastName" required
              placeholder="Enter your last name" value="{{ old('lastName') }}">
            <span class="help-block" hidden>@lang('website.Please enter your last name')</span>
          </div>
        </div>
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>@lang('website.Email Adrress')</label></div>
          <div class="input-group col-12">
            <input name="email" type="email" class="form-control email-validate" id="inlineFormInputGroup" required
              placeholder="Enter Your Email" value="{{ old('email') }}">
            <span class="help-block" hidden>@lang('website.Please enter your valid email address')</span>
          </div>
        </div>
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>@lang('website.Password')</label></div>
          <div class="input-group col-12">
            <input name="password" id="password" type="password" class="form-control password" required
              placeholder="@lang('website.Please enter your password')">
            <span class="help-block" hidden>@lang('website.Please enter your password')</span>

          </div>
        </div>
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>@lang('website.Confirm Password')</label></div>
          <div class="input-group col-12">
            <input type="password" class="form-control password" id="re_password" name="re_password" required
              placeholder="Enter Your Password">
            <span class="help-block" hidden>@lang('website.Please re-enter your password')</span>
            <span class="help-block" hidden>@lang('website.Password does not match the confirm password')</span>
          </div>
        </div>
        <div class="form-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>Referral Code</label></div>
          <div class="input-group col-12">
            <input type="text" class="form-control" name="referral_code" id="" value="{{ $result['referral'] }}" placeholder="Referral Code" required>
          </div>
        </div>
        <div class="from-group mb-3">
          <div class="col-12"> <label for="inlineFormInputGroup"><strong
                style="color: red;">*</strong>@lang('website.Gender')</label></div>
          <div class="input-group col-12">
            <select class="form-control field-validate" name="gender" id="inlineFormCustomSelect" required>
              <option selected value="">@lang('website.Choose...')</option>
              <option value="0" @if (!empty(old('gender')) and old('gender') == 0) selected
                @endif)>@lang('website.Male')</option>
              <option value="1" @if (!empty(old('gender')) and old('gender') == 1) selected
                @endif>@lang('website.Female')</option>
            </select>
            <span class="help-block" hidden>@lang('website.Please select your gender')</span>
          </div>
        </div>
        <div class="from-group mb-3">
          <div class="input-group col-12">
            <input required style="margin:4px;" class="form-controlt checkbox-validate" type="checkbox">
            @lang('website.Creating an account means you are okay with our') @if (!empty($result['commonContent']['pages'][3]->slug))&nbsp;<a
                href="{{ URL::to('/page?name=' . $result['commonContent']['pages'][3]->slug) }}">@endif
            @lang('website.Terms and Services')@if (!empty($result['commonContent']['pages'][3]->slug))</a>@endif, @if (!empty($result['commonContent']['pages'][1]->slug))<a
                href="{{ URL::to('/page?name=' . $result['commonContent']['pages'][1]->slug) }}">@endif
            @lang('website.Privacy Policy')@if (!empty($result['commonContent']['pages'][1]->slug))</a> @endif &nbsp; and
            &nbsp; @if (!empty($result['commonContent']['pages'][2]->slug))<a
                href="{{ URL::to('/page?name=' . $result['commonContent']['pages'][2]->slug) }}">@endif
            @lang('website.Refund Policy') @if (!empty($result['commonContent']['pages'][3]->slug))</a>@endif.
            <span class="help-block" hidden>@lang('website.Please accept our terms and conditions')</span>
          </div>
        </div>

        <div class="col-12 col-sm-12">
          <button type="submit" class="btn btn-light swipe-to-top">@lang('website.Create an Account') </button>
        </div>
      </form>
      </div>  
    </div>
  </div>
@endsection

<style>
  .error-field {
    border: 1px red solid !important;
    background: #ff00002b !important
  }

</style>
