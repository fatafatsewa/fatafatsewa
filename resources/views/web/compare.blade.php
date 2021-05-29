@extends('web.layout')
@section('content')

<div class="container-fuild">
  <nav aria-label="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('website.COMPARE PRODUCT')</li>
          </ol>
      </div>
    </nav>
</div> 



<!-- Compare Content -->
<section class="compare-content pro-content">

  <div class="container">
    <div class="page-heading-title">
        <h2> @lang('website.COMPARE PRODUCT') 
        </h2>
     
        </div>
</div>

  <div class="container">
    <div class="row">

      @foreach($result['products'] as $key=>$products)
      <div class="col-lg-6">
          <table class="table">
              <thead>
                <td align="center">
                  <div class="img-div">
                      <img class="img-fluid" src="{{$products['product_data'][0]->image_path}}">
                  </div>

                </td>
              </thead>

              <tbody>
                <tr>
                  <td>
                    <h2 >{{$products['product_data'][0]->products_name}}</h2>
                  </td>

                </tr>
                <tr>
                  <td>
                    <span>@lang('website.Price')&nbsp;:&nbsp;</span>
                    <span class="price-tag">
                      {{Session::get('symbol_left')}}
                      {{$products['product_data'][0]->products_price+0*session('currency_value')}}
                      {{Session::get('symbol_right')}}
                  </span>
                </td>
                </tr>
                 <tr>
                   <td>
                     <div class="specs-list compare-product-{{ $key }}">
                   {!! $products['product_data'][0]->products_description !!}
                  </div>
                  </td>
                 </tr>
               
                <tr>
                  <td>
                    <div class="detail-buttons">
                        <a href="javascript:void(0)" class="btn-lg btn btn-secondary btn-view-detail" data-class="compare-product-{{ $key }}">View More</a>
                        <div class="share"><a href="{{ URL::to("/deletecompare")}}/{{$products['product_data'][0]->products_id}}">Remove &nbsp;<i class="fas fa-trash-alt"></i></a> </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
      </div>
      @endforeach
    </div>
  </div>
</section>

<style>
  .specs-list{
    height: 300px;
    overflow: hidden;
  }
</style>
<script>
  $(document).on('click', '.btn-view-detail', function() {

      var clss=$(this).data('class');
      console.log(clss)
        $(`.${clss}`).css('height', 'auto')
        // $('#specs-list').removeClass('div-faded')

        $(this).remove();
      })
  </script>

@endsection
