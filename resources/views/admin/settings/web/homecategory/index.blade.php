@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Home Category<small>ListingAllHomeCategories...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Home Category</li>
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
            <div class="col-lg-10 form-inline">
  <div class="box-tools pull-right">
             <a href="{{ URL::to('admin/addhomecategory') }}" type="button" class="btn btn-block btn-primary">Add Home Category</a>
            </div>
          </div>
           
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		  @if (count($errors) > 0)
                          @if($errors->any())
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{$errors->first()}}
                            </div>
                          @endif
                      @endif

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('labels.ID') }}</th>
                      <th>Category Name</th>
                      <th>Category Slug</th>
                      <th>{{ trans('labels.AddedModifiedDate') }}</th>
                      <th>{{ trans('labels.languages') }}</th>
                      <th>{{ trans('labels.Action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($result['homecategory'])>0)
                    @foreach ($result['homecategory'] as $key=>$homecategory)
                        <tr>
                            <td>{{ $homecategory->homecategory_id }}</td>
                             <td>{{ $homecategory->homecategory_title }}</td>
                             <td>{{ $homecategory->homecategory_slug }}</td>
                            <td><strong>{{ trans('labels.AddedDate') }}: </strong> {{ date('d M, Y', strtotime($homecategory->date_added)) }}<br>
                            <strong>{{ trans('labels.ModifiedDate') }}: </strong>@if(!empty($homecategory->date_status_change)) {{ date('d M, Y', strtotime($homecategory->date_status_change)) }}  @endif<br>
                            <strong>{{ trans('labels.ExpiryDate') }}: </strong>@if(!empty($homecategory->expires_date)) {{ date('d M, Y', strtotime($homecategory->expires_date)) }}  @endif</td>

                            <td>{{ $homecategory->language_name }}</td>
                            <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{ URL::to('admin/edithomecategory')}}/{{ $homecategory->homecategory_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                            
                              <!-- deleteSliderModal -->
 {!! Form::open(array('url' =>'admin/deleteHomecategory', 'name'=>'deleteHomecategory', 'id'=>'deleteSlider', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
          {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
          {!! Form::hidden('homecategory_id',  $homecategory->homecategory_id, array('class'=>'form-control', 'id'=>'homecategory_id')) !!}
          <button type="submit" ><i class="fa fa-trash" aria-hidden="true"></i></button>
{!! Form::close() !!}
                        </tr>
                    @endforeach
                    @else
                       <tr>
                            <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                       </tr>
                    @endif
                  </tbody>
                </table>
                <div class="col-xs-12 text-right">
                {!! $result['homecategory']->appends(\Request::except('page'))->render() !!}
                	{{--$result['homecategory']->links('vendor.pagination.default')--}}
                </div>
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
