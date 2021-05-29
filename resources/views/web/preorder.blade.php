@extends('web.layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="preorder-apply-form" style="width: 100%; margin:auto; margin-top:30px">
        @if (session('preorder_requested') && session('preorder_requested') === true)
          <div class="text-center">
            <h1 style="font-size:35px">
              Thank you for pre ordereing Samsung Galaxy Z Fold 2.
            </h1>
             <img src="{{ asset('web/images/samsung_galaxy_z.png') }}" alt="" class="text-center" style="width: 400px; margin-top:20px">
            <p>We've recieved your Pre-Order request. One of our team members will get back to you soon.</p>
          </div>
        @else
        <div class="text-center">
        <h2 class=""><strong>Pre order Samsung Galaxy Z Fold 2 Now</strong></h2>
        <img src="{{ asset('web/images/samsung_galaxy_z.png') }}" alt="" class="text-center" style="width: 400px; margin-top:20px"></div>
        <br><br>
          <form method="POST" id="preorder--apply-form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <h5>Device Information:</h5>
            <div class="form-group row">
             <div class="col-md-4 col-sm-6 mb-3">
                <label for="">Device Model:</label>
                <input type="hidden" name="device_model" value="Samsung Galaxy Z Fold 2">
                <input type="text" disabled value="Samsung Galaxy Z Fold 2" class="form-control" required>
             </div>
             <div class="col-md-4 col-sm-6 mb-3">
                <label for="">Device Ram:</label>
                <select name="ram" id="ram" class="form-control" required>
                  <option value="" disabled selected>Choose RAM</option>
                  <option disabled value="4GB">4GB</option>
                  <option disabled value="6GB">6GB</option>
                  <option disabled value="8GB">8GB</option>
                  <option selected value="12GB">12GB</option>
                </select>
             </div>

             <div class="col-md-4 col-sm-6 mb-3">
                <label for="">Device Storage:</label>
                <select required name="storage" id="storage" class="form-control">
                <option value="" disabled selected>Choose storage</option>
                <option disabled value="32GB">32GB</option>
                <option disabled value="64GB">64GB</option>
                <option disabled value="128GB">128GB</option>
                <option  value="256GB">256GB</option>
                <option  value="512GB">512GB</option>
                </select>
              </div>
            </div>

            <h3><b>User Information</b></h3>
            <div class="form-group row">
              <div class="col-md-4 col-sm-12">
                <label for="">Customer Name:</label>
                <input type="text" class="form-control form-first-name" name="full_name" placeholder="your full name.." required>
              </div>
              <div class="col-sm-4">
                  <label for="">Email:</label>
                  <input type="email" class="form-control form-email" name="email" placeholder="your email id.." required>
                </div>
                <div class="col-sm-4">
                    <label for="">Contact Number:</label>
                    <input type="text" class="form-control form-contact-number" name="contact_number" placeholder="your phone number.." required>
                  </div>
              
            </div>
            
            <h5>Address:</h5>
            <div class="form-group row">
            <div class="col-md-4 col-sm-4 mb-3">
              <label for="">City</label>
              <select name="city" class="form-control city--selector" required>
                <option value="">Select City</option>
                @foreach(config('shippingaddress') as $city => $addresses)
                <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
              </select>
                </div>

                <div class="col-md-4 col-sm-12  mb-3">
                  <label for=""> @lang('website.Address')</label>
                  <select name="address" class="form-control address--selector" required>
                    <option value="">Select Option</option>
                  </select>
                </div>

                <div class="col-md-4 col-sm-12  mb-3">
                  <label for="municipality">Municipality/VDC</label>
                  <input type="text" name="municipality" class="form-control" placeholder="Municipality/VDC" required>
                </div>

                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="municipality">Ward No.</label>

                    <input type="text" class="form-control" name="ward_no"  required placeholder="Ward No.">

                </div>

                <div class="col-md-8 col-sm-12 mb-3">
                    <label for="">Nearest Popular Place</label>
                    <input type="text" class="form-control" name="tole" required placeholder="Tole">
                </div>
            </div>
         
        
            <div class="form-group row form-check">
              <h4 style="color:blue;">To be confirmed by Customer</h4>
              <input type="checkbox" name="condition" id="terms" required>
              <label class="form-check-label" for="advance">I agree to pay Rs. 5000 as an advance for prebooking of the above device.</label>
            </div>
              <div class="form-group text-center">
                <button class="btn btn-secondary" type="submit">Pre-Order Request</button>
              </div>
          </form>
        @endif
      </div>
    </div>
  </div>

  <script>
    var addresses_= {!! json_encode(config('shippingaddress')) !!}

  jQuery(document).on('change', '.city--selector', function() {
    let city = $(this).val();
    if(city) {
      $('.address--selector').empty().append('<option value="">Select Option</option>');

      let addresses = addresses_[city]
      addresses.forEach(element => {
        $('.address--selector').append(`<option value="${element}">${element}</option>`)
      });
    }else {

    }
  })
  </script>

  <script>
    jQuery(document).ready(function(e) {
      $("#exchange--apply-form").submit(function(event) {
        if ($('.user--phone-select').val() !== 'other') {
          if (!$('.phone_purchased_at').val()) {
            event.preventDefault();
            alert('Please select phone purchased time.');
            return;
          }
        } else {
          if (!$('.form-phone-model').val() || !$('.form-purchase-price').val()) {
            event.preventDefault();
            alert('Please enter phone name/model and purchase price');
            return;
          }
        }

        $('#exchange--apply-form').submit()

      });
      $('.exchange--image-input').change(function() {
        let file = $(this).prop('files')[0]
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png"];
        var image_holder = $(this).data('image-holder');
        if ($.inArray(fileType, validImageTypes) < 0) {
          alert('Only images are allowed')
          $(this).val(null);
        } else {
          let reader = new FileReader();
          reader.onload = () => {
            $(`.${image_holder}`).html(`<img src="${reader.result}" style="width:100%">`)
          };
          reader.readAsDataURL(file);
        }
      })

     

  </script>
@endsection

<style>
  .exchange-apply-form .image--upload-section {
    background: rgba(128, 128, 128, 0.102);
    /* height: 150px; */
    border: 1px solid rgba(128, 128, 128, 0.664)
  }

  .exchange-apply-form .image--upload-section p {
    font-size: 16px;
    padding-top: 60px;
    padding-bottom: 60px;
  }

  .error-field {
    border: 1px red solid !important;
    background: #ff00002b !important
  }

</style>
