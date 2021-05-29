
<!-- .block-slideshow -->
            <div class="block-slideshow block-slideshow--layout--with-departments block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 d-none"></div>
                        <div class="col-12 col-lg-9">
                            {{-- <div class="block-slideshow__body ml-0">
                                <div class="owl-carousel"> 
                                     @foreach($result['slides']->sortByDesc('id') as $key=>$slides_data)
             
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
                                        
                </a>
              
                                    @endforeach
  </div> 
                                </div> --}}

                                <div id="carouselExampleIndicators" class="carousel slide mt-4" data-ride="carousel">
                                  <ol class="carousel-indicators">
                                    @php 
                                      $count = 0
                                    @endphp
                                    @foreach($result['slides']->sortByDesc('id') as $key=>$slides_data)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $count }}" class="{{ ($count == 0) ? 'active': '' }}"></li>
                                    @php 
                                    $count++
                                  @endphp
                                    @endforeach
                                  </ol>
                                  <div class="carousel-inner">
                                    @php 
                                    $count = 0
                                  @endphp
                                    @foreach($result['slides']->sortByDesc('id') as $key=>$slides_data)

                      <div class="carousel-item {{ ($count == 0) ? 'active' : '' }}">

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
              <img class="d-block w-100" src="{{asset('').$slides_data->path}}" alt="">

                </a>


              </div>
              @php 
              $count++
            @endphp
                                    @endforeach
                                  </div>
                                  {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a> --}}
                                </div>


                            </div> 
                        <div class="col-lg-3 col-12 d-none d-md-block fatafat-banner">  
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


 