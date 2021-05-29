<!-- site__footer -->
            <footer class="site__footer">
                <div class="site-footer">
                    <div class="container">
                        <div class="site-footer__widgets">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="site-footer__widget footer-contacts">
                                        <div class="mb-4">
                                            <img src="/web/images/playstore.png" width="140px" alt="">
                                            <img src="/web/images/appstore.png" width="140px" alt="">

                                        </div>
                                        <h5 class="footer-contacts__title">Contact Us</h5>
                                        {{-- <div class="footer-contacts__text">
                                            @lang('website.Footer text 1')
                                        </div> --}}
                                        <ul class="footer-contacts__contacts">
                                            <li><i class="footer-contacts__icon fas fa-globe-americas"></i> Newroad-22, Kathmandu</li>
                                            <li><i class="footer-contacts__icon far fa-envelope"></i> {{$result['commonContent']['setting'][3]->value}}</li>
                                            <li><i class="footer-contacts__icon fas fa-mobile-alt"></i>{{$result['commonContent']['setting'][11]->value}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2">
                                    <div class="site-footer__widget footer-links">
                                        <h5 class="footer-links__title">Information</h5>
                                        <ul class="footer-links__list">
                                            
                                           <li class="footer-links__item">  <a class="footer-links__link" href="{{ URL::to('/')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Home')">@lang('website.Home')</a> </li>
                   <li class="footer-links__item">  <a class="footer-links__link" href="{{ URL::to('/shop')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Shop')">@lang('website.Shop')</a> </li>
                  <li class="footer-links__item">  <a class="footer-links__link" href="{{ URL::to('/orders')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Orders')">@lang('website.Orders')</a> </li>
                   <li class="footer-links__item">  <a class="footer-links__link" href="{{ URL::to('/viewcart')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Shopping Cart')">@lang('website.Shopping Cart')</a> </li>           
                   <li class="footer-links__item">  <a class="footer-links__link" href="{{ URL::to('/wishlist')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Wishlist')">@lang('website.Wishlist')</a> </li>   
                   <li class="footer-links__item"> <a class="footer-links__link" href="{{ URL::to('/contact')}}" data-toggle="tooltip" data-placement="left" title="@lang('website.Contact Us')">@lang('website.Contact Us')</a> </li>
                   <li class="footer-links__item"> <a class="footer-links__link" href="{{ URL::to('/warranty-check')}}" data-toggle="tooltip" data-placement="left" title="Check Warranty">Check Warranty</a> </li>
                 
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-3">
                                    <div class="site-footer__widget footer-links">
                                        <h5 class="footer-links__title">Categories</h5>
                                        <ul class="footer-links__list">
                                          
@if(count($result['commonContent']['pages']))
              @foreach($result['commonContent']['pages'] as $page)
                  <li class="footer-links__item"> <a class="footer-links__link" href="{{ URL::to('/page?name='.$page->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$page->name}}">{{$page->name}}</a> </li>
              @endforeach
            @endif
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-3">
                                    <div class="site-footer__widget footer-newsletter">
                                      <h5 class="footer-newsletter_a_title">@lang('website.Subscribe')</h5>
                                    @if(!empty($result['commonContent']['setting'][118]) and $result['commonContent']['setting'][118]->value==1)
                                    <form class="footer-newsletter__form mailchimp-form"  action="{{url('subscribeMail')}}" name="subscribe">
                                        <input type="text" name="nospam:blank" value="" style="display:none;" />
                                        <label class="sr-only" for="footer-newsletter-address">Email Address</label>
                                        <input type="email" class="footer-newsletter__form-input form-control"  name="email" class="email" placeholder="@lang('website.Your email address here')">
                                         
                                        <input class="footer-newsletter__form-button btn btn-primary" type="submit" name="subscribe-footer" value="Subscribe">
                                        
                                         <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>
            
                                  <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                                    </form>
                                    @endif
                                    <div class="footer-newsletter__text footer-newsletter__text--social">
                                        Follow us on social networks
                                    </div>
                                    <ul class="footer-newsletter__social-links">
                             
                                 <li class="footer-newsletter__social-link footer-newsletter__social-link--facebook">
                    @if(!empty($result['commonContent']['setting'][50]->value))
                        <a href="{{$result['commonContent']['setting'][50]->value}}"   data-toggle="tooltip" data-placement="bottom" title="@lang('website.facebook')"><i class="fab fa-facebook-f"></i></a>
                    @else
                    <a href="{{$result['commonContent']['setting'][50]->value}}"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.facebook')"><i class="fab fa-facebook-f"></i></a>
                    @endif
                  </li> 
                        

                  <li class="footer-newsletter__social-link footer-newsletter__social-link--youtube">
                    @if(!empty($result['commonContent']['setting'][51]->value))
                        <a href="{{$result['commonContent']['setting'][51]->value}}"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.google')"><i class="fab fa-google" ></i></a>
                    @else
                        <a href="#"><i class="fab sk fa-google"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.google')"></i></a>
                    @endif
                  </li>
                <li class="footer-newsletter__social-link footer-newsletter__social-link--instagram">
                     
                    @if(!empty($result['commonContent']['setting'][53]->value))
                        <a href="{{$result['commonContent']['setting'][53]->value}}"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.Instagram')"><i class="fab fa-instagram"></i></a>
                    @else
                        <a href="#"  data-toggle="tooltip" data-placement="bottom" title="@lang('website.Instagram')"><i class="fab fa-instagram"></i></a>
                    @endif
                  </li>  
 
                                    </ul>
 
                                    <div class="site-footer__payments mt-4">
                                        <h5>We Accept</h5>
                                        <img src="{{asset('web')}}/custom/assets/themes/fatafatsewa/content/images/payments/esewa.png" alt="" width="80px" style="margin-right:10px">
                                        <img src="{{asset('web')}}/custom/assets/themes/fatafatsewa/content/images/payments/mastercard.png" alt="" width="70px" style="margin-right:10px">
                                        <img src="{{asset('web')}}/custom/assets/themes/fatafatsewa/content/images/payments/cellpay.png" alt="" width="80px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div>
                <div class="site-footer__bottom" style="background:#222">
                    <div class="container">
                    <div class="site-footer__copyright">
                        ©&nbsp;{{ date('Y') }} Fatafat Sewa Pvt Ltd. All rights reserved. 
                        </div>
                        {{-- <span class="text-right">Powered by <a href="https://nepapixels.com/" target="_blank">Nepa Pixels</a></span> --}}
                      
                    </div>
                </div>
                </div>
            </footer>
            <!-- site__footer / end -->


