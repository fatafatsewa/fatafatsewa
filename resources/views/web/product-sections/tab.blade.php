@if($result['special']['success']==1 or $result['top_seller']['success']==1 or $result['most_liked']['success']==1 )
<!-- .block-product-columns -->
                <div class="block-product-columns d-lg-block d-none block--highlighted">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                              @if($result['most_liked']['success']==1)
                                <div class="block-header">
                                    <h3 class="block-header__title">@lang('website.MostLiked')</h3>
                                    <div class="block-header__divider"></div>
                                </div>
                                 <div class="block-product-columns__column">
                                    @php $count=1; @endphp
                                    @foreach($result['most_liked']['product_data'] as $key=>$products)

                                    <div class="block-product-columns__item">
                                       @include('web.common.productsm') 
                                    </div>
                                    @if($count==4) @break @endif
                                    @php $count++; @endphp
                                     @endforeach

                                </div>
                                @endif
                            </div>
                            <div class="col-4">
                               @if($result['special']['success']==1)
                                <div class="block-header">
                                    <h3 class="block-header__title">@lang('website.Special')</h3>
                                    <div class="block-header__divider"></div>
                                </div>
                                <div class="block-product-columns__column">
                                   @php $count=1; @endphp
                                    @foreach($result['special']['product_data'] as $key=>$products)

                                    <div class="block-product-columns__item">
                                       @include('web.common.productsm') 
                                    </div>
                                    @if($count==4) @break @endif
                                    @php $count++; @endphp
                                     @endforeach

                                </div>
                                 @endif
                            </div>
                            <div class="col-4">
                              @if($result['top_seller']['success']==1)
                                <div class="block-header">
                                    <h3 class="block-header__title">@lang('website.TopSales')</h3>
                                    <div class="block-header__divider"></div>
                                </div>
                                <div class="block-product-columns__column">
                                  @php $count=1; @endphp
                                    @foreach($result['top_seller']['product_data'] as $key=>$products)

                                    <div class="block-product-columns__item">
                                       @include('web.common.productsm') 
                                    </div>
                                    @if($count==4) @break @endif
                                    @php $count++; @endphp
                                     @endforeach
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .block-product-columns / end -->


@endif
 
    <!-- .block-brands -->
                <div class="block-brands">
                    <div class="container">
                        <div class="block-brands__slider">
                            <div class="owl-carousel">
                                @foreach($result['commonContent']["manufacturers"] as $key=>$manufacturers)
                                <div class="block-brands__item">
                                    <a href="{{$manufacturers->manufacturers_url}}" target="_blank"><img src="{{asset('').$manufacturers->manufacturer_image}}" alt="{{$manufacturers->manufacturer_name}}"></a>
                                </div>
                                @endforeach 
                                 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .block-brands / end -->



 