@include('web.headers.fixedHeader')
<!-- //header style One -->

<header id="headerOne" class="header-area header-nine header-desktop d-none d-lg-block d-xl-block">
  <div class="header-mini bg-top-bar">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4">
            <div class="navbar-lang">
              @if(count($languages) > 1)
              <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    {{  session('language_name')}}
                  </button>
                  <div class="dropdown-menu" >
                    @foreach($languages as $language)
                    <a onclick="myFunction1({{$language->languages_id}})" class="dropdown-item" href="#">                      
                      {{$language->name}}
                    </a>                   
                    @endforeach                   
                  </div>
              </div> 
              @include('web.common.scripts.changeLanguage')
              @endif
              @if(count($currencies) > 1)
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" >
                    {{session('currency_code')}}
                  </button>
                  <div class="dropdown-menu">
                    @foreach($currencies as $currency)
                    <a onclick="myFunction2({{$currency->id}})" class="dropdown-item" href="#">                      
                      <span>{{$currency->code}}</span>
                    </a>
                    @endforeach
                  </div>
                </div>
                @include('web.common.scripts.changeCurrency')
              @endif
            </div>
        </div>
        <div class="col-12">
          {{-- @if(auth()->guard('customer')->check()) --}}
          <ul style="    padding-left: 0;
            display: flex;
            list-style: none;
            padding-right: 0px;
            padding: 10px!important;
            align-items: center;
            float: right;">
            {{-- <li class="phone-header">
             
              <a href="#"> 
                  <span class="">
                    <span class="title">Customer Service</span>     <br>
                                  
                    <span class="items" dir="ltr">{{$result['commonContent']['setting'][11]->value}}</span>
                  </span>                   
              </a>
            </li> --}}
            <li class="header--right-icons">
              <button style="float: left" class="btn btn-light" type="button">
                <i class="fas fa-phone"></i>
            </button>
            <a href="tel:{{$result['commonContent']['setting'][11]->value}}" style="float: left;
              display: flex;
              margin-top: 8px;
              font-weight: 200;
              margin-left: 10px;">{{$result['commonContent']['setting'][11]->value}}</a>
            </li> 


            <a href="/compare">
            <li class="header--right-icons">
              <button style="float: left" class="btn btn-light" type="button">
                <i class="fas fa-columns"></i>
            </button>
          </a>
            <a href="/compare" style="float: left;
            display: flex;
            margin-top: 8px;
            font-weight: 200;
            margin-left: 10px;">Compare</a>
            </li> 

            @if(auth()->guard('customer')->check())

              <li class="header--right-icons">
                <button style="float: left" class="btn btn-light" type="button">
                  <i class="fas fa-handshake"></i>
              </button>
              <a href="/refer-friends" style="float: left;
              display: flex;
              margin-top: 8px;
              font-weight: 200;
              margin-left: 10px;">Refer & Earn</a>
              </li> 
              @endif
            @if(auth()->guard('customer')->check())
               
          <li class="dropdown profile-tags header--right-icons">
            <button style="float: left" class="btn btn-light dropdown-toggle" type="button" id="dropdownAccountButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>
            <span style="float: left;
            display: flex;
            margin-top: 8px;
            margin-left: 10px;">{{ auth()->guard('customer')->user()->first_name }}</span>
            <div class="dropdown-menu" aria-labelledby="dropdownAccountButton">
                <a href="javascript:void(0)" class="dropdown-item">Reward Points: {{ auth('customer')->user()->reward_points }}</a>
                <a class="dropdown-item" href="{{url('profile')}}">@lang('website.Profile')</a>
                <a class="dropdown-item" href="{{url('wishlist')}}">@lang('website.Wishlist')</a>
                <a class="dropdown-item" href="{{url('compare')}}">@lang('website.Compare')&nbsp;(<span id="compare">0</span>)</a>
                <a class="dropdown-item" href="{{url('orders')}}">@lang('website.Orders')</a>
                <a class="dropdown-item" href="{{url('logout')}}">@lang('website.Logout')</a>
             
            </div>
          </li>
          @endif

          @if(!auth('customer')->check())
          <li class="header--right-icons">
            <a href="javascript:void(0)" style="float: left" class="trigger--login btn btn-light" type="button">
              <i class="fas fa-user"></i>
            </a>
          <a class="trigger--login" href="javascript:void(0)" style="float: left;
          display: flex;
          margin-top: 8px;
          font-weight: 200;
          margin-left: 10px;">Login/Register</a>
          </li> 
          @endif
          <li class="header--right-icons">
            <a href="{{ URL::to('/wishlist')}}" class="btn btn-light" >
                <i class="far fa-heart"></i>
                <span class="badge badge-secondary total_wishlist">{{$result['commonContent']['total_wishlist']}}</span>
            </a>
          </li> 
           <li class="header--right-icons cart-header dropdown head-cart-content">
                  @include('web.headers.cartButtons.cartButton3') 
                </li>
        </div>
      </div>
    </div> 
  </div>
  <div class="header-maxi bg-header-bar">
      <div class="container">
        <div class="row align-items-center">    
        <div class="col-12 col-lg-3"> 
<a href="{{ URL::to('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom">
            @if($result['commonContent']['settings']['sitename_logo']=='name')
            <?=stripslashes($result['commonContent']['settings']['website_name'])?>
            @endif
        
            @if($result['commonContent']['settings']['sitename_logo']=='logo')
            <img style="max-width: 170px !important; padding: 6px;" class="img-fluid" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
            @endif
            </a>

        </div>  
          <div class="col-12 col-lg-6">  
            <form class="form-inline" action="{{ URL::to('/shop')}}" method="get">   
              <div class="search-field-module">   
                  <input type="hidden" name="category" class="category-value" value="">
                  @include('web.common.HeaderCategories')
                <button class="btn btn-secondary swipe-to-top dropdown-toggle header-selection" type="button" id="headerOneCartButton"  
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                  data-toggle="tooltip" data-placement="bottom" title="@lang("website.Choose Any Category")"> 
                  @lang("website.Choose Any Category")
                </button> 
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">   
                    @php    productCategories(); @endphp                                                                 
                </div>
                <div class="search-field-wrap">
                    <input class="website-product__search"  type="search" name="search" placeholder="@lang('website.Search entire store here')..." data-toggle="tooltip" data-placement="bottom" title="@lang('website.Search Products')" value="{{ app('request')->input('search') }}">
                    <button class="btn btn-secondary swipe-to-top" data-toggle="tooltip" 
                    data-placement="bottom" title="@lang('website.Search Products')">
                    <i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12 col-lg-3">
            <ul class="top-right-list"> 
               
          </ul>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="header-navbar logo-nav bg-menu-bar">
      <div class="container">
        <nav id="navbar_1_2" class="navbar navbar-expand-lg  "> 
          <div class=" navbar-collapse">
              {{-- <div class="nav-panel__departments">
                                    <!-- .departments -->
                                    <div class="departments  departments--open departments--fixed " data-departments-fixed-by=".block-slideshow">
                                        <div class="departments__body" style="display:none" id="category-toogle">
                                            <div class="departments__links-wrapper">
                                                <div class="departments__submenus-container"></div>
                                                <ul class="departments__links">
                                                  <form id="my-form" class="form-inline" action="{{ URL::to('/shop')}}" method="get">   
<input type="hidden" name="category" class="category-value" value="">

 @foreach($result['commonContent']["manufacturers"] as $key=>$manufacturers)
                                
                               

                                <li class="departments__item">
                                                        <a class="departments__item-link" href="{{$manufacturers->manufacturers_url}}">
                                                            {{$manufacturers->manufacturer_name}}
                                                        </a>
                                                    </li>
                                
                                @endforeach 
</form>
                                                </ul>
                                            </div>
                                        </div>
                                        <button class="departments__button" onclick="myFunction()">
                                            <svg class="departments__button-icon" width="18px" height="14px">
                                                <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#menu-18x14"></use>
                                            </svg>
                                            Shop By Brand
                                            <svg class="departments__button-arrow" width="9px" height="6px">
                                                <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#arrow-rounded-down-9x6"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- .departments / end -->
                                </div> --}}
              <ul class="navbar-nav ">
                {!! $result['commonContent']["menusRecursive"] !!}
                  
                <li class="nav-item ">
                  <a class="btn btn-secondary" href="{{url('shop?type=special')}}">@lang('website.SPECIAL DEALS')</a>
                </li> 

              </ul>
            </div>
          
        </nav>
      </div>
    </div>
    {{-- @if(!auth('customer')->check())
    @include('web.common.authmodal')
    @endif     --}}
</header> 

@if(request()->segment(1) !== 'product-detail')
<div class="mf-navigation-mobile" id="mf-navigation-mobile">
  <div class="navigation-list container">
    <a href="/" class="navigation-icon navigation-mobile_home ">
    <i class="fa fa-home" aria-hidden="true"></i> {{-- Home--}}</a>
    <a href="/shop" class="navigation-icon navigation-mobile_cat" id="navigation-mobile_cat">
    <i class="fa fa-bars" aria-hidden="true"></i>{{-- Category --}}</a>
    <a href="/viewcart" class="navigation-icon navigation-mobile_cart ">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>{{-- Cart --}}</a>

    <a href="{{ (auth('customer')->check()) ? '/profile' : '/login' }}" class="navigation-icon navigation-mobile_search">
    <i class="fa fa-user" aria-hidden="true"></i>{{-- login --}}</a>
   
  </div>
</div>
@endif
<script>
  var lastScrollTop = 0;
 window.addEventListener("scroll", function(){  
 var st = window.pageYOffset || document.documentElement.scrollTop;  
 if (st > lastScrollTop){
     document.getElementById("mf-navigation-mobile").style.bottom = "0%";
 } else {
    document.getElementById("mf-navigation-mobile").style.bottom = "-100%";
 }
 lastScrollTop = st;
}, false);
</script>

<style>
  .mf-navigation-mobile {
 position: fixed;
 bottom: 0;
 left: 0;
 right: 0;
 z-index: 999999;
 background-color: #fff;
 border-top: 1px solid #ccc;
 transition: bottom 2s;
}
.mf-navigation-mobile .navigation-list {
 display: flex;
 align-items: center;
 justify-content: space-between;
 padding: 10px 15px;
}
.navigation-list i {
 font-size: 24px;
 color: #ff6a00;
}
@media only screen and (max-width:2400px){
 div#mf-navigation-mobile {
   display: none;
}
}
@media only screen and (max-width:769px){
 .mf-navigation-mobile {
  display:block !important;
 }
}

 </style>