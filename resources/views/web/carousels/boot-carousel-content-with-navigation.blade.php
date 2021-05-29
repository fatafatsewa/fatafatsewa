<!-- .block-slideshow -->
            <div class="block-slideshow block-slideshow--layout--with-departments block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 d-none"></div>
                        <div class="col-12 col-lg-9">
                            <div class="block-slideshow__body ml-0">
                                <div class="owl-carousel">
                                     @foreach($result['slides'] as $key=>$slides_data)
             
                @if($slides_data->type == 'category')
                  <a  class="block-slideshow__slide" href="{{ URL::to('/shop?category='.$slides_data->url)}}">
                @elseif($slides_data->type == 'product')
                  <a class="block-slideshow__slide"  href="{{ URL::to('/product-detail/'.$slides_data->url)}}">
                @elseif($slides_data->type == 'mostliked')
                  <a  class="block-slideshow__slide" href="{{ URL::to('shop?type=mostliked')}}">
                @elseif($slides_data->type == 'topseller')
                  <a  class="block-slideshow__slide" href="{{ URL::to('shop?type=topseller')}}">
                @elseif($slides_data->type == 'deals')
                  <a  class="block-slideshow__slide" href="{{ URL::to('shop?type=deals')}}">
                @endif
                  <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('{{asset('').$slides_data->path}}')"></div>
                                        <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('{{asset('').$slides_data->path}}')"></div>
                                        <div class="block-slideshow__slide-content"> 
                                            <div class="block-slideshow__slide-button">
                                                <span class="btn btn-primary btn-lg">Shop Now</span>
                                            </div>
                                        </div>
                </a>
                </div> 
                                    @endforeach

                                </div>
                            </div> 
                        <div class="col-lg-3 col-12 fatafat-banner">  
                            <div class="row">
                               @if(count($result['commonContent']['homeBanners'])>0)
                @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                    @if($homeBanners->type==1 or $homeBanners->type==2) 
                               <div class="single-img col-lg-12 col-md-6 col-sm-6 col-12">
                                <a href="{{ $homeBanners->banners_url}}"><img class="img-fluid" src="{{asset('').$homeBanners->path}}" alt="Banner"></a>
                               </div>
                              @endif
                @endforeach
            @endif  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .block-slideshow / end -->


 