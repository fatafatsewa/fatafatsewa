@extends('web.layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="exchange-apply-form" style="width: 700px; margin:auto; margin-top:30px">
        @if (session('exchange_requested') && session('exchange_requested') === true)

          <div class="text-center">
            <h1 style="font-size:35px">
              Thank you for your exchange application.
            </h1>
            <p>We've recieved your exchange request. One of our team members will get back to you soon.</p>
            <br>
            <p><a href="/exchange-apply">Apply another exchange</a></p>
          </div>
        @else
            <h2 class="text-center"><strong>Exchange Application Form</strong></h2>
            <br><br>

          <form method="POST" id="exchange--apply-form" enctype="multipart/form-data" class="form">
            {!! csrf_field() !!}
            <h3 class="text-center"><b>User Information</b></h3>
            <div class="form-group row">
              <div class="col-sm-6">
                <label for="">First Name:</label>
                <input type="text" class="form-control form-first-name" name="first_name" placeholder="Your first name here.." required>
              </div>
              <div class="col-sm-6">
                <label for="">Last Name:</label>
                <input type="text" class="form-control form-last-name" name="last_name" placeholder="Your last name here.." required>
              </div>
            </div>
            <div class="form-group row ">
              <div class="col-sm-6">
                <label for="">Email:</label>
                <input type="text" class="form-control form-email" name="email" placeholder="your email.." required>
              </div>
              <div class="col-sm-6">
                <label for="">Contact Number:</label>
                <input type="text" class="form-control form-contact-number" placeholder="Your contact number.." name="contact_number" required>
              </div>
            </div>
            <div class="form-group">
              <label for=""><h4> Citizenship Picture</h4></label>
              <div class="row">
                <div class="col-6 mb-3 col-sm-6">
                  <div class="image--upload-section citizenship--front-image text-center">
                    <p>Front</p>

                  </div>
                  <br>
                  <input type="file" name="citizenship_front" class="form-citizenship-front exchange--image-input"
                    required data-image-holder="citizenship--front-image">
                </div>
                <div class="col-6 mb-3 col-sm-6">
                  <div class="image--upload-section citizenship--back-image text-center">
                    <p>Back</p>
                  </div>
                  <br>
                  <input type="file" name="citizenship_back" class="form-citizenship-back exchange--image-input"
                    data-image-holder="citizenship--back-image" required>
                </div>
              </div>
              <br>
              <h5 class="text-center">Mobile Phone Information</h5>
              <div class="form-group" >
                <label for="">Your Phone Model</label>
                <select name="users_phone_id" required class="form-control user--phone-select">
                  <option value="" selected="true" disabled>Choose phone model</option>
                  @foreach ($result['products'] as $product)
                    <option value="{{ $product->products_id }}" data-price="{{ $product->products_price }}">
                      {{ $product->products_name }}</option>
                  @endforeach
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="form-group phone--purchased_at d-none">
                <label for="">Purchased At</label>
                <select name="purchased_at" class="form-control phone_purchased_at">
                  <option value=""></option>
                  <option value="1week">One Week</option>
                  <option value="30days">30 Days</option>
                  <option value="30+days">30+ Days</option>
                </select>
              </div>
              <div class="price---estimation"></div>
              <div class="form-group row phone--name-price d-none">
                <div class="col-sm-6">
                  <label for="">Phone Model/Name</label>
                  <input type="text" class="form-control form-phone-model" name="phone_model">
                </div>
                <div class="col-sm-6">
                  <label for="">Purchase Price</label>
                  <input type="number" id="" class="form-control form-purchase-price" name="purchase_price">
                </div>

              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="">IMEI Number</label>
                  <input type="text" class="form-control form-imei-number" name="imei_number" placeholder="find in cover or about phone setting" required>
                </div>
                <div class="col-sm-6">
                  <label for="">Phone Condition</label>
                  <select name="phone_condition" id="exchange_phone_condition" class="form-control" required>
                    <option value="" selected="true" disabled>Specify phone condition</option>
                    <option value="working">Working</option>
                    <option value="dead">Dead</option>
                    <option value="NoProblem">No Problem at all</option>
                  </select>
                </div>
                {{-- <div class="col-sm-6">
                  <label for="">Purchase Date</label>
                  <input type="date" id="" class="form-control form-purchase-date" name="purchase_date" required>
                </div> --}}

              </div>
              <div class="form-group d-none working-phone-options">
                <label for=""><strong>Phone Problems</strong></label>
                <br>
                <label for="volume-problem">
                  <input type="checkbox" name="phone_problems[]" id="volume-problem" value="Problem with volume button">
                  <span>Problem with volume button</span>
                </label>
                <br>
                <label for="bluetooth-problem">
                  <input type="checkbox" name="phone_problems[]" id="bluetooth-problem" value="Problems with Wifi/GPS/Bluetooth">
                  <span>Problems with Wifi/GPS/Bluetooth</span>
                </label>
                <br>
                <label for="speaker-problem">
                  <input type="checkbox" name="phone_problems[]" id="speaker-problem" value="Problem with speakers/Earphone">
                  <span>Problem with speakers/Earphone</span>
                </label>
                <br>
                <label for="home-button-problem">
                  <input type="checkbox" name="phone_problems[]" id="home-button-problem" value="Problem with Power/Home button">
                  <span>Problem with Power/Home button</span>
                </label>
                <br>
                <label for="charging-problem">
                  <input type="checkbox" name="phone_problems[]" id="charging-problem" value="Problem with charging">
                  <span>Problem with charging</span>
                </label>
                <br>
                <label for="network-problem">
                  <input type="checkbox" name="phone_problems[]" id="network-problem" value="Problem with Network/3G/4G">
                  <span>Problem with Network/3G/4G</span>
                </label>
                <br>
                <label for="restart-problem">
                  <input type="checkbox" name="phone_problems[]" id="restart-problem" value="Auto Restart">
                  <span>Auto Restart</span>
                </label>
                <br>
                <label for="patches-problem">
                  <input type="checkbox" name="phone_problems[]" id="patches-problem" value="Patches on screen">
                  <span>Patches on screen</span>
                </label>
                <br>
                <label for="brokenscreen-problem">
                  <input type="checkbox" name="phone_problems[]" id="brokenscreen-problem" value="Screen Broken">
                  <span>Screen Broken</span>
                </label>
                <br>
                <label for="touch-problem">
                  <input type="checkbox" name="phone_problems[]" id="touch-problem" value="Problem with Touch/Display">
                  <span>Problem with Touch/Display</span>
                </label>
                <br>
                <label for="backcamera-problem">
                  <input type="checkbox" name="phone_problems[]" id="backcamera-problem" value="Faulty Back Camera">
                  <span>Faulty Back Camera</span>
                </label>
                <br>
                <label for="faulty-battery-problem">
                  <input type="checkbox" name="phone_problems[]" id="faulty-battery-problem" value="Faulty Battery">
                  <span>Faulty Battery</span>
                </label>
                <br>

                <label for="faulty-frontcamera">
                  <input type="checkbox" name="phone_problems[]" id="faulty-frontcamera" value="Faulty Front Camera">
                  <span>Faulty Front Camera</span>
                </label>
                <br>

                <label for="excellent-condition">
                  <input type="checkbox" name="phone_problems[]" id="excellent-condition" value="Excellent Condition">
                  <span>Excellent Condition</span>
                </label>
              </div>
              {{-- @foreach ($result['products'] as $product)
                {{ dd($product->products_price) }}
              @endforeach --}}
              <div class="form-group">
                <label for="">Exchange With</label>
                <select name="exchange_product_id" required class="form-control form-exchange-with">
                  <option value="" selected="true" disabled>Choose exchange to</option>
                  @foreach ($result['products'] as $product)
                    <option value="{{ $product->products_id }}" data-price="{{ $product->products_price }}">
                      {{ $product->products_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-secondary" type="submit">Apply Exchange</button>
              </div>

          </form>
        @endif
      </div>
     </div>
    </div>

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

      $('.user--phone-select').change(function() {
        calculateEstimatePrice();
        if ($(this).val() === '' && $(this).val() === null) {
          $('.phone--name-price').addClass('d-none')
          $('.phone--purchased_at').addClass('d-none')
        } else if ($(this).val() === 'other') {
          $('.phone_purchased_at').val('')
          $('.phone--name-price').removeClass('d-none')
          $('.phone--purchased_at').addClass('d-none')
        } else {
          $('.form-purchase-price').val('')
          $('.form-phone-model').val('')

          $('.phone--name-price').addClass('d-none')
          $('.phone--purchased_at').removeClass('d-none')
        }
      })

      function calculateEstimatePrice() {
        if ($('.user--phone-select').val() && $('.phone_purchased_at').val() && $('.user--phone-select').val() !==
          'other') {
          let phone_price = $('.user--phone-select option:selected').data('price');
          let purchase_date = $('.phone_purchased_at').val();
          let percentage = 0;
          if (purchase_date === '1week') percentage = 20
          if (purchase_date === '30days') percentage = 30
          if (purchase_date === '30+days') percentage = 45

          let deduct_price = (percentage / 100) * phone_price;
          let deducted_price = phone_price - deduct_price;
          deducted_price = Math.round(deducted_price)
          $('.price---estimation').html(`
                    <h4> Estimated Price : Rs. ${deducted_price} </h4>
                    <p class="text-info">This is only estimated value. Price may change on actual exchange process</p>
                  `)
        } else {
          $('.price---estimation').html(``)
        }
      }
      $('.phone_purchased_at').change(function() {
        calculateEstimatePrice();
      })

      $('#exchange_phone_condition').change(function() {
        if ($(this).val() === 'working') {
          $('.working-phone-options').removeClass('d-none')
        } else {
          $('.working-phone-options').addClass('d-none')
        }
      })
    });

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
