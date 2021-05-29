@extends('web.layout')

@section('content')
 <div class="container mt-4">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
               <h3>{{ __('Verify Your Email Address') }}</h3>
              </div>

              <div class="card-body">
                  @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                          {{ __('A fresh verification link has been sent to your email address.') }}
                      </div>
                  @endif

                  <form id="email-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
                   @csrf
</form>

                  {{ __('Before proceeding, please check your email for a verification link.') }}
                  {{ __('If you did not receive the email') }}, <a onclick="event.preventDefault(); document.getElementById('email-form').submit();">{{ __('click here to request another') }}</a>.
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
