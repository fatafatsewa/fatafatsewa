@if(!empty($result['news']['news_data']))
      <!-- .block-posts -->
                <div class="block-posts block-posts--layout--list-sm" data-layout="list-sm" style="background:#f2f2f2 !important">
                    <div class="container">
                        <div class="block-header">
                            <h3 class="block-header__title">@lang('website.From our News') 
 </h3> 
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
                        <div class="block-posts__slider">
                            <div class="owl-carousel">
                                
 @foreach($result['news']['news_data'] as $key=>$news_data)

 
                              <div class="post-card">
                                    <div class="post-card__image">
                                        <a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}">
                                            <img src="{{asset('').$news_data->image_path}}" alt="{{$news_data->news_name}}">
                                        </a>
                                    </div>
                                    <div class="post-card__info">
                                        <div class="post-card__name">
                                            <a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}">{{$news_data->news_name}}</a>
                                        </div>
                                        <div class="post-card__date">{{date('d-M-Y', strtotime($news_data->created_at))}}</div>
                                        <div class="post-card__content">
                                            <p> <?php
                        $descriptions = substr(strip_tags($news_data->news_description), 0, 100);
                        echo stripslashes($descriptions);
                      ?></p>
                                        </div>
                                        <div class="post-card__read-more">
                                            <a href="{{ URL::to('/news-detail/'.$news_data->news_slug)}}" class="btn btn-secondary btn-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                 @endforeach  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .block-posts / end -->
 
@endif