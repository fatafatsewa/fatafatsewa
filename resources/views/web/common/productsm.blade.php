 <div class="product-card product-card--layout--horizontal">
                                            <div class="product-card__badges-list">
                                            </div>
                                            <div class="product-card__image">
                                                <a href="#"><img src="{{asset('').$products->image_path}}" alt="{{$products->products_name}}"/></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__name">
                                                    <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
                                                </div>
                                                     <?php
      if(!empty($products->discount_price)){
        $discount_price = $products->discount_price * session('currency_value');
      }
      $orignal_price = $products->products_price * session('currency_value');

      if(!empty($products->discount_price)){

      if(($orignal_price+0)>0){
        $discounted_price = $orignal_price-$discount_price;
        $discount_percentage = $discounted_price/$orignal_price*100;
       }else{
         $discount_percentage = 0;
         $discounted_price = 0;
      }
  }

      ?>  
<div class="product__rating-stars">
  <div class="rating">
    <div class="rating__body">
      <div class="pro-rating">
              <fieldset class="disabled-ratings">                                           
                <label class = "full fa @if($products->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                <label class = "full fa @if($products->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>                                          
                <label class = "full fa @if($products->rating >= 3) active @endif" for="star_3" title="@lang('website.pretty_good_3_stars')"></label>                                          
                <label class = "full fa @if($products->rating >= 2) active @endif" for="star_2" title="@lang('website.meh_2_stars')"></label>
                 <label class = "full fa @if($products->rating >= 1) active @endif" for="star1" title="@lang('website.meh_1_stars')"></label>
              </fieldset>      
            </div>

    </div>
  </div>

</div>
      
                                                    <div class="product-card__actions">
           @if(!empty($products->discount_price))
          <span class="product-card__new-price">{{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}</span>
        <span class="product-card__old-price"> {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span>
        @else
          <span class="product-card__new-price"> {{Session::get('symbol_left')}}&nbsp;{{$orignal_price+0}}&nbsp;{{Session::get('symbol_right')}}</span>
        @endif            
                                                               
                                                            </div>
                                            </div>
                                            
                                        </div>