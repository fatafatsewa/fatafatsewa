
<?php $qunatity=0; ?>
                @foreach($result['commonContent']['cart'] as $cart_data)
                  <?php $qunatity += $cart_data->customers_basket_quantity; ?>
                @endforeach
                  @if(count($result['commonContent']['cart'])>0)
                
  <div class="indicator indicator--mobile">
                                    <a href="{{ URL::to('/viewcart')}}" class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="20px" height="20px">
                                                    <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#cart-20"></use>
                                                </svg>
                                                <span class="indicator__value ms2_total_count">{{ $qunatity }}</span>
                                            </span>
                                        </a>
                                </div>  
        @else

              <div class="indicator indicator--mobile">
                                    <a href="{{ URL::to('/viewcart')}}" class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="20px" height="20px">
                                                    <use xlink:href="{{asset('web')}}/custom/assets/themes/fatafatsewa/images/sprite.svg#cart-20"></use>
                                                </svg>
                                                <span class="indicator__value ms2_total_count">0</span>
                                            </span>
                                        </a>
                                </div> 
                @endif
 
