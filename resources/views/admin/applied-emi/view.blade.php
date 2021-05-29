@extends('admin.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> EMI Request Detail</h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
            {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li><a href="/admin/emi/display">EMI Requets</a></li>
        <li class="active">EMI Requests Detail</li>
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
                  <a href="/admin/emi/display" class="btn btn-default">Back</a>
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
                        <td width="200px">
                          <strong>Full name</strong>
                        </td>
                        <td>
                          {{ $result['emi']->first_name.' '.$result['emi']->middle_name.' '.$result['emi']->last_name }}
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Email Address</strong></td>
                        <td>{{ $result['emi']->email }}</td>
                      </tr>
                      <tr>
                        <td><strong>Bank</strong></td>
                        <td>{{ $result['emi']->bank_->name }}</td>
                      </tr>
                      
                      <tr>
                        <td><strong>Contact</strong></td>
                        <td>{{ $result['emi']->contact }}</td>
                      </tr>
                      <tr>
                        <td><strong>Address</strong></td>
                        <td>{{ $result['emi']->address }}</td>
                      </tr>
                      <tr>
                        <td><strong>Date of birth (AD)</strong></td>
                        <td>{{ $result['emi']->date_of_birth_ad }}</td>
                      </tr>
                      <tr>
                        <td><strong>Date of birth (BS)</strong></td>
                        <td>{{ $result['emi']->date_of_birth_bs }}</td>
                      </tr>
                      <tr>
                        <td><strong>Has Card?</strong></td>
                        <td>{{ ($result['emi']->has_card == 1) ? "Yes":"No" }}</td>
                      </tr>
                      @if($result['emi']->has_card != 1)
                      <tr>
                        <td><strong>Vehicle</strong></td>
                        <td>{{ $result['emi']->vehicle }}</td>
                      </tr>
                      <tr>
                        <td><strong>Residental Status</strong></td>
                        <td>{{ $result['emi']->residental_status }}</td>
                      </tr>


                      <tr>
                        <td><strong>No. of dependencies</strong></td>
                        <td>{{ $result['emi']->no_of_dependencies }}</td>
                      </tr>

                      <tr>
                        <td><strong>Occupation</strong></td>
                        <td>{{ $result['emi']->occupation }}</td>
                      </tr>

                      <tr>
                        <td><strong>Montly Income</strong></td>
                        <td>{{ $result['emi']->monthly_income }}</td>
                      </tr>

                      <tr>
                        <td><strong>Employment length</strong></td>
                        <td>{{ $result['emi']->employment_length }}</td>
                      </tr>
                   



                      <tr>
                        <td><strong>Salary Certificate</strong></td>
                        <td><img src="{{ $result['emi']->salary_certificate }}" alt="" width="60%"></td>
                      </tr>

                      <tr>
                        <td><strong>Citizenship</strong></td>
                        <td><img src="{{ $result['emi']->citizenship }}" alt="" width="60%"></td>
                      </tr>

                      <tr>
                        <td><strong>Photo</strong></td>
                        <td><img src="{{ $result['emi']->photo }}" alt="" width="60%"></td>
                      </tr>
                      @endif


                      <tr>
                        <td><strong>Emi Mode</strong></td>
                        <td>{{ $result['emi']->emi_mode }} Months</td>
                      </tr>

                      <tr>
                        <td><strong>Down Payment</strong></td>
                        <td>Rs. {{ $result['emi']->down_payment }}</td>
                      </tr>

                      <tr>
                        <td><strong>Finance Amount</strong></td>
                        <td>Rs. {{ $result['emi']->finance_amount }}</td>
                      </tr>


                      <tr>
                        <td><strong>Emi Per Month</strong></td>
                        <td>Rs. {{ $result['emi']->emi_per_month }}</td>
                      </tr>

                      
                      <tr>
                        <td><strong>Product Detail</strong></td>
                        <td><a target="_blank"
                            href="/product-detail/{{ $result['emi']->product_detail->products_slug }}">{{ $result['emi']->product_detail->products_name }}</a>
                        </td>
                      </tr>
                    
                      <tr>
                        <td><strong>Request Date</strong></td>
                        <td>{{ date('M d, Y', strtotime($result['emi']->created_at)) }}</td>
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
