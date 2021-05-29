@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Home Category <small>EditHomeCategory...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/homecategory')}}"><i class="fa fa-bars"></i> Home Category</a></li>
      <li class="active">Edit Home Category</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->
    <style>
      .selectedthumbnail {
          display: block;
          margin-bottom: 10px;
          padding: 0;
      }
      .thumbnail {
          padding: 0;
      }
      .closimage{
        position: relative
      }
      </style>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Home Category </h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                    <br>
                        @if (count($errors) > 0)
                              @if($errors->any())
                                <div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  {{$errors->first()}}
                                </div>
                              @endif
                          @endif
                        <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                        <!-- /.box-header -->
                        <!-- form start -->
                         <div class="box-body">

                            {!! Form::open(array('url' =>'admin/updateHomecategory', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

                                {!! Form::hidden('id',  $result['home_category']->homecategory_id , array('class'=>'form-control', 'id'=>'id')) !!} 
                                
                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Language') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="languages_id">
                                          @foreach($result['languages'] as $language)
                                              <option value="{{$language->languages_id}}" @if($language->languages_id==$result['home_category']->languages_id) selected @endif>{{ $language->name }}</option>
                                          @endforeach
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.ChooseLanguageText') }}</span>
                                  </div>
                                </div>

                             

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                  <div class="col-sm-10 col-md-4">



                                   @if(!empty($result['home_category']->homecategory_title))
                                    {!! Form::text('homecategory_title', $result['home_category']->homecategory_title, array('class'=>'form-control ', 'id'=>'homecategory_title')) !!}
                                   @else
                                    {!! Form::text('homecategory_title', '', array('class'=>'form-control ', 'id'=>'homecategory_title')) !!} 
                                   @endif
                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    Edit Title</span>
                                  </div>
                                </div>
 <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                  <div class="col-sm-10 col-md-4">



                                   @if(!empty($result['home_category']->homecategory_slug))
                                    {!! Form::text('homecategory_slug', $result['home_category']->homecategory_slug, array('class'=>'form-control ', 'id'=>'homecategory_slug')) !!}
                                   @else
                                    {!! Form::text('homecategory_slug', '', array('class'=>'form-control ', 'id'=>'homecategory_slug')) !!} 
                                   @endif
                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    Edit Title</span>
                                  </div>
                                </div>
                                <div class="form-group" hidden>
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1" @if($result['home_category']->status==1) selected @endif>{{ trans('labels.Active') }}</option>
                                          <option value="0" @if($result['home_category']->status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
                                      </select>
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.StatusSliderText') }}</span>
                                  </div>
                                </div>


                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/homecategory')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                              </div>
                              <!-- /.box-footer -->
                            {!! Form::close() !!}
                        </div>
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
