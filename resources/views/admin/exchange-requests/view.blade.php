@extends('admin.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Exchange Request Detail</h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
            {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li><a href="/admin/exchange-requests/display">Exchange Requets</a></li>
        <li class="active">Exchange Requests Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <!-- /.row -->
      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">


              <div class="row">
                <div class="col-xs-12">
                  <a href="/admin/exchange-requests/display" class="btn btn-default">Back</a>
                  <br>
                  <br>
                  <table class="table table-bordered table-striped">
                    {{-- <thead>
                      <tr>
                        <th>Requested By</th>
                        <th>Phone Model</th>
                        <th>Exchange With</th>
                        <th>Contact Number</th>
                        <th>Requested Date</th>
                        <!-- <th>{{ trans('labels.MainCategory') }}</th> -->
                        <th>{{ trans('labels.Action') }}</th>
                      </tr>
                    </thead> --}}
                    <tbody>
                      <tr>
                        <td>
                          <strong>Full name</strong>
                        </td>
                        <td>
                          {{ $result['exchange_request']->first_name . ' ' . $result['exchange_request']->last_name }}
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Email Address</strong></td>
                        <td>{{ $result['exchange_request']->email }}</td>
                      </tr>
                      <tr>
                        <td><strong>Contact Number</strong></td>
                        <td>{{ $result['exchange_request']->contact_number }}</td>
                      </tr>
                      @if($result['exchange_request']->users_phone_id)
                      <tr>
                        <td><strong>Customer's Phone</strong></td>
                        <td><a target="_blank"
                          href="/product-detail/{{ $result['exchange_request']->customer_phone->products_slug }}">{{ $result['exchange_request']->customer_phone->products_name }}</a>
                      </td>
                      </tr>
                      @else
                      <tr>
                        <td><strong>Customer's Phone Model</strong></td>
                        <td>{{ $result['exchange_request']->phone_model }}</td>
                      </tr>
                      @endif
                      <tr>
                        <td><strong>Requested Phone</strong></td>
                        <td><a target="_blank"
                            href="/product-detail/{{ $result['exchange_request']->product_detail->products_slug }}">{{ $result['exchange_request']->product_detail->products_name }}</a>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>IMEI Number</strong></td>
                        <td>{{ $result['exchange_request']->imei_number }}</td>
                      </tr>
                      <tr>
                        <td><strong>Purchased At</strong></td>
                        <td>{{ $result['exchange_request']->purchased_at }}</td>
                      </tr>
                      <tr>
                        <td><strong>Phone Condition</strong></td>
                        <td>{{ $result['exchange_request']->phone_condition }}</td>
                      </tr>
                      <tr>
                        <td><strong>Phone Problems</strong></td>
                        <td>{{ $result['exchange_request']->phone_problems }}</td>
                      </tr>
                      <tr>
                        <td><strong>Request Date</strong></td>
                        <td>{{ date('M d, Y', strtotime($result['exchange_request']->created_at)) }}</td>
                      </tr>
                      <tr>
                        <td><strong>Citizenship Front</strong></td>
                        <td class="text-center"><img src="{{ $result['exchange_request']->citizenship_front }}" alt=""
                            width="300px"></td>
                      </tr>
                      <tr>
                        <td><strong>Citizenship Back</strong></td>
                        <td class="text-center"><img src="{{ $result['exchange_request']->citizenship_back }}" alt=""
                            width="300px"></td>
                      </tr>
                    </tbody>
                  </table>
                  {{-- @if ($categories != null)
                    <div class="col-xs-12 text-right">
                      {{ $categories->links() }}
                    </div>
                  @endif --}}
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
