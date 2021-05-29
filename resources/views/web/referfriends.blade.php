@extends('web.layout')
@section('content')

  <div class="container-fuild">
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">@lang('website.Home')</a></li>
          <li class="breadcrumb-item"><a href="{{ URL::to('/profile') }}">@lang('website.Profile')</a></li>
          <li class="breadcrumb-item active" aria-current="page">@lang('website.Change Password')</li>
        </ol>
      </div>
    </nav>
  </div>
  <section class="order-one-content pro-content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3  d-none d-lg-block d-xl-block">
          <div class="heading">
            <h2>
              @lang('website.My Account')
            </h2>
            <hr>
          </div>
          @if (Auth::guard('customer')->check())
            <ul class="list-group">
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/profile') }}">
                  <i class="fas fa-user"></i>
                  @lang('website.Profile')
                </a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/wishlist') }}">
                  <i class="fas fa-heart"></i>
                  @lang('website.Wishlist')
                </a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/orders') }}">
                  <i class="fas fa-shopping-cart"></i>
                  @lang('website.Orders')
                </a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/shipping-address') }}">
                  <i class="fas fa-map-marker-alt"></i>
                  @lang('website.Shipping Address')
                </a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/logout') }}">
                  <i class="fas fa-power-off"></i>
                  @lang('website.Logout')
                </a>
              </li>
              <li class="list-group-item">
                <a class="nav-link" href="{{ URL::to('/refer-friends') }}">
                  <i class="fas fa-handshake"></i>
                  Refer & Earn
                </a>
              </li>
            </ul>
          @endif
        </div>
        <div class="col-12 col-lg-9 ">
          <div class="heading">
            <h2>
              Refer friends and earn points
            </h2>
            <hr>
          </div>
          @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              {{ session()->get('message') }}
            </div>

          @endif

          <div class="text-center" style="padding-top: 40px">
            @if(auth('customer')->user()->referral_code !== null)
              <p style="font-size: 19px"><strong>Referral Code: </strong> {{ auth('customer')->user()->referral_code }}</p>
              <p style="font-size: 17px">{{ route('refer-n-earn', ['referral' => auth('customer')->user()->referral_code]) }}</p>


              <!-- AddToAny BEGIN -->
              <ul class="share-buttons" data-source="simplesharingbuttons.com">
                <li><a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('refer-n-earn', ['referral' => auth('customer')->user()->referral_code]) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a class="share-twitter" href="https://twitter.com/intent/tweet?source={{ route('refer-n-earn', ['referral' => auth('customer')->user()->referral_code]) }}" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a></li>
                <li><a class="share-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('refer-n-earn', ['referral' => auth('customer')->user()->referral_code]) }}&title=&summary=&source={{ route('refer-n-earn', ['referral' => auth('customer')->user()->referral_code]) }}" target="_blank" ><i class="fa fa-linkedin"></i></a></li>
              </ul>
  <!-- AddToAny END -->
            @endif
            <form action="/generate-referral-code" method="POST">
              {!! csrf_field() !!}
              
              <button class="btn btn-secondary" type="submit"><i class="fa fa-refresh"></i>&nbsp; {{ (auth('customer')->user()->referral_code !== null) ? 'Refresh': 'Generate' }}
                Referral Code</button>
            </form>
          </div>
          <!-- ............the end..... -->
        </div>
      </div>
    </div>
  </section>
  <style>
    ul.share-buttons{
    list-style: none;
    padding: 0;
  }

  ul.share-buttons .share-facebook .fa{
    background: #1877f2;
    padding: 6px 11px;
  }
  
  ul.share-buttons .share-twitter .fa{
    background: #71c9f8;
    padding: 6px 6px;

  }

  ul.share-buttons .share-linkedin .fa{
    background: #0077b5;
    padding: 6px 8px;

  }
  ul.share-buttons li a .fa{
    color: white;
    border-radius: 10px;
    font-size: 20px;
  }
  ul.share-buttons li{
    display: inline;
  }
  
  ul.share-buttons .sr-only{
    position: absolute;
    clip: rect(1px 1px 1px 1px);
    clip: rect(1px, 1px, 1px, 1px);
    padding: 0;
    border: 0;
    height: 1px;
    width: 1px;
    overflow: hidden;
  }
    </style>
@endsection
