@extends('web.layout')
@section('content')
  <div class="container">
    <div class="row mt-5">
      @foreach ($result['products']['product_data'] as $products)
      <div class="col-12 col-lg-3 col-sm-6 griding">
        @include('web.common.product')
    </div>
      @endforeach
    </div>
  </div>
@endsection

<style>
  .error-field {
    border: 1px red solid !important;
    background: #ff00002b !important
  }

</style>
