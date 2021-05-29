@extends('admin.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Banks </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
            {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li class="active">Banks</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <div class="box-tools pull-right">
                <a href="{{ URL::to('admin/banks/add') }}" type="button"
                  class="btn btn-block btn-primary">{{ trans('labels.AddNewCategory') }}</a>
              </div>
            </div>

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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Available Options</th>
                        <!-- <th>{{ trans('labels.MainCategory') }}</th> -->
                        <th>{{ trans('labels.Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($result['banks'] as $key => $bank)
                        <tr>
                          <td>
                            {{ $key + 1 }}
                          <td>
                            {{ $bank->name }}
                          </td>
                          <td>
                            {{ $bank->email }}
                          </td>
                          <td>
                            {{ $bank->available_options }}
                          </td>
                           <td>
                            <a data-toggle="tooltip" data-placement="bottom" title="Edit"
                              href="{{ url('admin/banks/edit/' . $bank->id) }}" class="badge bg-light-blue"><i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @if ($bank->id > 0)<a id="delete"
                                bank_id="{{ $bank->id }}" href="#" class="badge bg-red "><i class="fa fa-trash"
                                  aria-hidden="true"></i></a>@endif
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
