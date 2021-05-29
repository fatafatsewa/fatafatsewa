@extends('web.layout')
@section('content')
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12" style="margin-top: 40px">
        @if (isset($found) && $found)
        <h1 style="font-size:35px">Your Service and Support Coverage</h1>

        <img src="{{ $order_product_detail['image'] }}" width="250px">
        {{-- <p>{{ dd($order_product_detail)}} </p> --}}
        <br>
        <br>
        <h3>{{ $order_product_detail['products_name']}}</h3>
        <p>Serial Number: {{ $order_product_detail['serial_number']}}</p>
        <p><a href="/warranty-check">Check another serial number</a></p>
{{-- {{ dd($result['order_detail']) }} --}}
        <div class="row" style="padding:10px">
          <div style="border: 1px solid black;   margin:auto;  margin-bottom:15px !important; background: rgba(15, 255, 15, 0.060)" class="col-md-5  align-self-center col-md-offset-3 text-left">
            <br>
            <h5>Purchase Detail</h5>
            <hr>
            <p><strong>Customer: </strong>{{ $result['order_detail']->customers_name }}</p>
            <p><strong>Email: </strong>{{ $result['order_detail']->email }}</p>
            <p><strong>Purchase Date: </strong>{{ date("F j, Y, g:i a", strtotime($result['order_detail']->date_purchased)) }}</p>

          </div>
          <div style="border: 1px solid black; margin:auto;  margin-bottom:15px !important; background: rgba(15, 255, 15, 0.060)" class="col-md-5  align-self-center col-md-offset-3 text-left">
            <br>
            <h5>Warranty Detail</h5>
            <hr>
            {!! $order_product_detail['warranty'] !!}
          </div>
        </div>
        <div class="warranty--detail text-left">
          
        </div>
        
        @else
          <h1 style="font-size:35px">
            Check Your Service and Support Coverage
          </h1>
          <p>Review your product's warranty status and eligibility to purchase additional coverage.</p>

          <form method="get" style="width:350px; margin:auto; margin-top:30px">
            <div class="form-group">
              <p>Enter your serial number</p>
              <input type="text"
                value="{{ isset($params) && isset($params['serial_number']) ? $params['serial_number'] : '' }}"
                class="form-control {{ isset($found) && $found === false ? 'error-field' : '' }}" style="height: 50px"
                required name="serial_number">
              @if (isset($found) && !$found)
                <p class="text-danger" style="margin-top: 20px">We’re sorry, but this serial number isn’t valid. Please
                  check your information and try again.</p>
              @endif
            </div>
            <div class="form-group">
              <button class="btn btn-secondary swipe-to-top">Check</button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
@endsection

<style>
  .error-field {
    border: 1px red solid !important;
    background: #ff00002b !important
  }

</style>
