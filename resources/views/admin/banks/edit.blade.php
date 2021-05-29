@extends('admin.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Edit Bank</small> </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
            {{ trans('labels.breadcrumb_dashboard') }}</a></li>
        <li><a href="{{ URL::to('admin/banks/display') }}"><i class="fa fa-database"></i>Banks</a></li>
        <li class="active">Edit Bank</li>
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
              <h3 class="box-title">Edit Bank </h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box box-info">
                    <!-- form start -->
                    <br>

                    @if (count($errors) > 0)
                      @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                          {{ $errors->first() }}
                        </div>
                      @endif
                    @endif
                    <div class="box-body">

                      {!! Form::open([
                      'url' => 'admin/banks/update/'.$result["bank"]->id,
                      'method' => 'post',
                      'class' => 'form-horizontal
                      form-validate',
                      'enctype' => 'multipart/form-data'
                      ]) !!}
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="">Bank Name</label>
                          <input type="text" class="form-control" name="name" value="{{ $result['bank']->name }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="">Email Address</label>
                          <input type="email" class="form-control" name="email" value="{{ $result['bank']->email }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="">Available options</label>
                          <select name="available_options[]" id="" class="form-control" multiple>
                            <option value="card">Card</option>
                            <option value="loan">Loan</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="">Emi Form (PDF)</label>
                          <input type="file" name="emi_form" class="form-control" accept="application/pdf">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="">Email Template</label>
                          <textarea name="email_template" id="editor1" cols="30" rows="10"
                            class="form-control">
                          {{ $result['bank']->email_template }}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <button class="btn btn-primary">Save</button>
                        </div>
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
  <script src="{!!  asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
  <script type="text/javascript">
    $(function() {

      //for multiple languages
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');

      //bootstrap WYSIHTML5 - text editor

    });

  </script>
@endsection
