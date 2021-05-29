@extends('admin.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> EMI Requests </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
            {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="active">EMI Requests</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  @if (count($errors) > 0)
                    @if ($errors->any())
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                        {{ $errors->first() }}
                      </div>
                    @endif
                  @endif
                </div>
              </div>


              <div class="row">
                <div class="col-xs-12">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Bank</th>
                        <th>Emi Type</th>
                        <th>Product</th>
                        <th>Requested Date</th>
                        <th>{{ trans('labels.Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($result['emis'] as $key => $emi)
                      
                        <tr>
                          <td>
                            {{ $emi->full_name }}
                          </td>
                          <td>
                            {{ $emi->email }}
                          </td>
                          <td>
                            {{ $emi->bank_->name }}
                          </td>
                          <td>{{ $emi->emi_type }}</td>
                          <td>{{ $emi->product_detail->products_name }}</td>
                          <td>{{ date('M d, Y', strtotime($emi->created_at)) }}</td>
                          <td>
                            <a data-toggle="tooltip" data-placement="bottom" title="Edit"
                              href="{{ url('admin/emi/' . $emi->id . '/view') }}"
                              class="badge bg-light-blue"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      @endforeach

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
