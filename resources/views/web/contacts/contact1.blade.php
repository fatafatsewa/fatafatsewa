<!-- contact Content -->
<style>
.contact-content .contact-info li span {
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
</style>



<section class="pro-content no-padding">
  <div class="site__body">
            <div class="block-map block">
                <div class="block-map__body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.5909696532567!2d85.32690571486788!3d27.699034232464555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19805e162717%3A0x9bfc5b2e2177b81f!2sNepa%20Pixels%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1596786458037!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="page-header">
                <div class="page-header__container container">
             <div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.Contact Us')</li>
          </ol>
      </div>
    </nav>
</div> 
                  <div class="container">
    <div class="page-heading-title">
        <h2> @lang('website.Contact Us') 
        </h2>
     
        </div>
</div>    
                </div>
            </div>
            <div class="block">
                <div class="container">
                    <div class="card mb-0">
                        <div class="card-body contact-us contact-content">
                            <div class="contact-us__container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                                        <h4 class="contact-us__header card-title">Our Address</h4>
                                        <div class="contact-us__address">
                                           <p>Fatafat Sewa, Newroad-22, Kathmandu<br>Email: {{$result['commonContent']['setting'][3]->value}}<br>Mobile Number: {{$result['commonContent']['setting'][11]->value}}
                                            <br> Phone Number: {{$result['commonContent']['setting'][11]->value}}</p>


                           
{{-- <p> @lang('website.Contact us text')</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <h4 class="contact-us__header card-title">Leave us a Message</h4>
                                         <div class="form-start">
                  
                  @if(session()->has('success') )
                     <div class="alert alert-success">
                         {{ session()->get('success') }}
                     </div>
                  @endif

                  <form enctype="multipart/form-data" action="{{ URL::to('/processContactUs')}}" method="post">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                      <label class="first-label" for="email">@lang('website.Full Name')</label>
                      <div class="input-group"> 
                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('website.Please enter your name')" aria-describedby="inputGroupPrepend" required>
                        <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your name')</div>
                      
                      </div>
                      <label for="email">@lang('website.Email')</label>
                      <div class="input-group">                     
                          <input type="email"  name="email" class="form-control" id="validationCustomUsername" placeholder="@lang('website.Enter Email here').." aria-describedby="inputGroupPrepend" required>
                          <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your valid email address')</div>
                      </div>  
                      <label for="email">@lang('website.Message')</label>
                      <textarea type="text" name="message"  placeholder="@lang('website.write your message here')..." rows="5" cols="56"></textarea>
                      <div class="help-block error-content invalid-feedback" hidden>@lang('website.Please enter your message')</div>

                      <button type="submit" class="btn btn-primary swipe-to-top">@lang('website.Submit') <i class="fas fa-location-arrow"></i>                 
                     
                    </form>
                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>