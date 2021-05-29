@extends('web.layout')
@section('header-meta')

@php  
    $meta_title = $result['category']->meta_title ?? "Buy ". $result['category']->categories_name." in Nepal - Fafatasewa";
    $meta_description = $result['category']->meta_description ?? "Buy ". $result['category']->categories_name." at best price in Nepal - Fafatasewa";
    $meta_keywords = $result['category']->meta_keywords;
@endphp
<title>{{ $meta_title }}</title>
<meta name="description" content="{{ $meta_description }} online at best price in Nepal - Fatafatsewa}}"/>
  <meta property="og:title" content="{{ $meta_title }}" >
    <meta property="og:url" content="{{ request()->url() }}" >
    <meta property="og:description" content="{{$meta_description}}" >
<meta name="twitter:title" content="{{ $meta_title }}" >
    <meta name="twitter:description" content="{{ $meta_title }}" >
{{-- 
    @if(isset($result['detail']['product_data'][0]->default_images))
    <meta name="twitter:image" content="{{ asset($result['detail']['product_data'][0]->default_images) }}" >
    <meta name="og:image" content="{{ asset($result['detail']['product_data'][0]->default_images) }}" >
    @elseif(isset($result['detail']['product_data'][0]->images[0])) 
    <meta name="twitter:image" content="{{ asset($result['detail']['product_data'][0]->images[0]->image_path) }}" >
    <meta name="og:image" content="{{ asset($result['detail']['product_data'][0]->images[0]->image_path) }}" >
    @endif --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/nepali-date-converter/dist/nepali-date-converter.umd.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bs-ad-convertor@1.0.3/bs-ad-convertor.min.js"></script> --}}
<script src="/js/dc.js"></script>
@endsection
@section('content')
    <div class="site__body">
        <div class="container mt-3 mb-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($result['banners'] as $key => $banner)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($result['banners'] as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            @if ($banner->link)
                                <a href="{{ $banner->link }}">
                            @endif
                            <img class="d-block w-100" src="{{ $banner->banner_image }}" alt="First slide">
                        </div>
                        @if ($banner->link)

                            </a>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        @php $count=1; @endphp
        @foreach ($result['dash_categories'] as $homecategory)

            <div class="block block-products-carousel" data-layout="grid-4" data-mobile-grid-columns="2">
                <div class="container">
                    <div class="block-header">
                        <h3 class="block-header__title">
                            {{ $homecategory->categories_name }}
                        </h3>
                        <div class="block-header__divider"></div>
                        {{-- <ul class="block-header__groups-list">
                    <li><button type="button" class="block-header__group block-header__group--active"
                            data-category-id="{{ $result['categorywiseproducts'][$count]['category']->categories_slug }}">All</button>
                    </li>

                    @foreach ($result['children'][$count] as $child)
                        <li><button type="button" class="block-header__group"
                                data-category-id="{{ $child->categories_slug }}">{{ $child->categories_name }}</button>
                        </li>
                    @endforeach

                </ul> --}}
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
                                @if ($homecategory->products['success'] == 1)
                                    @foreach ($homecategory->products['product_data'] as $key => $products)
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

    </div>
@endsection
