{{-- <!-- Products content -->
@if ($result['products']['success'] == 1)
   @php $count=1; @endphp
       @foreach ($result['homecategory'] as $homecategory)  
<div class="block block-products-carousel @if ($count % 2 == 0) block--highlighted @endif" data-layout="grid-4">
                <div class="container">
                    <div class="block-header">
                        <h3 class="block-header__title">{{$homecategory}}</h3>
                        <div class="block-header__divider"></div>
                         <div class="block-header__arrows-list">
                                <button class="block-header__arrow block-header__arrow--left" type="button">
                                    <svg width="7px" height="11px">
                                        <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#arrow-rounded-left-7x11"></use>
                                    </svg>
                                </button>
                                <button class="block-header__arrow block-header__arrow--right" type="button">
                                    <svg width="7px" height="11px">
                                        <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#arrow-rounded-right-7x11"></use>
                                    </svg>
                                </button>
                            </div>
                    </div>
                    <div class="block-products-carousel__slider"> 
                        <div class="row">      
 
                        <div class="owl-carousel owl-loaded owl-drag"> 
                          

 @if ($result['products']['success'] == 1)
  @foreach ($result['categorywiseproducts'][$count]['product_data'] as $key => $products)
  
  @include('web.common.product_card_style.7')
 `
 @endforeach
       @endif
        
        </div>
                        </div>
                    </div>
                </div>
            </div>


 @php $count++; @endphp
        @endforeach
       

@endif --}}

<!-- Products content -->
@if ($result['products']['success'] == 1)
    @php $count=1; @endphp
    @foreach ($result['homecategory'] as $homecategory)

        <div class="block block-products-carousel" data-layout="grid-4" data-mobile-grid-columns="2">
            <div class="container">
                <div class="block-header">
                    <h3 class="block-header__title">
                        @if ($result['categorywiseproducts'][$count]['category']->custom_dashboard)
                            <a href="/category/{{ $result['categorywiseproducts'][$count]['category']->categories_slug }}">
                        @endif
                        {{ $homecategory }}
                        @if ($result['categorywiseproducts'][$count]['category']->custom_dashboard)
                            </a>
                        @endif

                    </h3>
                    <div class="block-header__divider"></div>
                    <ul class="block-header__groups-list">
                        <li><button type="button" class="block-header__group block-header__group--active"
                                data-category-id="{{ $result['categorywiseproducts'][$count]['category']->categories_slug }}">All</button>
                        </li>

                        @foreach ($result['children'][$count] as $child)
                            <li><button type="button" class="block-header__group"
                                    data-category-id="{{ $child->categories_slug }}">{{ $child->categories_name }}</button>
                            </li>
                        @endforeach

                    </ul>
                    <div class="block-header__arrows-list">
                        <button class="block-header__arrow block-header__arrow--left" type="button">
                            <svg width="7px" height="11px">
                                <use
                                    xlink:href="{{ asset('web') }}/custom/assets/themes/fatafatsewa/images/sprite.svg#arrow-rounded-left-7x11">
                                </use>
                            </svg>
                        </button>
                        <button class="block-header__arrow block-header__arrow--right" type="button">
                            <svg width="7px" height="11px">
                                <use
                                    xlink:href="{{ asset('web') }}/custom/assets/themes/fatafatsewa/images/sprite.svg#arrow-rounded-right-7x11">
                                </use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="block-products-carousel__slider">
                    <div class="block-products-carousel__preloader"></div>

                    <div class="row">

                        <div class="owl-carousel owl-loaded owl-drag ">


                            @if ($result['products']['success'] == 1)
                                @foreach ($result['categorywiseproducts'][$count]['product_data'] as $key => $products)
                                    <div class="block-products-carousel__column">
                                        @include('web.common.product_card_style.7')
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .block-products-carousel / end -->
        @php $count++; @endphp

    @endforeach
@endif
