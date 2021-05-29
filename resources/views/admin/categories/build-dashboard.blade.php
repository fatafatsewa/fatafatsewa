@extends('admin.layout')
@section('content')
    <div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Build Category Dashboard </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
                        {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.MainCategories') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header">
                         @if(session('message'))
                            <div class="alert alert-success">
                              {{ session('message') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-error">
                              {{ session('error') }}
                            </div>
                            @endif

                            <h3>Featured Banners</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <form method="post"
                                    action="/admin/categories/{{ $result['category'][0]->categories_id }}/build-dashboard/add-banner"
                                    enctype="multipart/form-data">
                                    <div class="col-sm-3">
                                        <input type="file" name="banner_image" id="" class="form-control">
                                        @error('banner_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                     <input type="text" class="form-control" placeholder="Link" name="link">
                                    </div>
                                    @csrf

                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success">
                                            Add Banner
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <br><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($result['banners'] as $key => $banner)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ $banner->banner_image }}" width="150px" alt=""></td>
                                            <td>{{ $banner->link }}</td>
                                            <td>{{ $banner->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.category-banner.delete', [$banner->category_id, $banner->id]) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">
                                                <h3>No Banner Added!!</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>


                            </table>
                        </div>
                    </div>

                    <div class="box">

                     <div class="box-header">
                         <h3>Sub Categories List</h3>
                     </div>
                     <div class="box-body">
                         <div class="row">
                             <form method="post"
                                 action="/admin/categories/{{ $result['category'][0]->categories_id }}/build-dashboard/add-category"
                                 enctype="multipart/form-data">
                                 <div class="col-sm-6"> 

                                   <select name="category_id" id="" class="form-control" required>
                                    <option value="">Select Sub Category</option>
                                    @foreach($result['childs'] as $child)
                                    <option value="{{ $child->categories_id }}">{{ $child->categories_name }}</option>
                                    @endforeach
                                   </select>
                                     @error('banner_image')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
 
                                 @csrf

                                 <div class="col-sm-3">
                                     <button type="submit" class="btn btn-success">
                                         Add Category
                                     </button>
                                 </div>
                             </form>
                         </div>
                         <br><br>
                         <div class="row">
                             <div class="col-sm-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Category Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($result['dashboard_categories'] as $key => $category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->categories_name }}</td>
                                                <td>
                                                    <a href="/admin/categories/{{ $result['category'][0]->categories_id }}/build-dashboard/{{ $category->categories_id }}/remove-category"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">
                                                    <h3>No Categories Added!!</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
       
       
                                </table>
                             </div>
                         </div>
                      
                     </div>
                 </div>
                </div>
            </div>
            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
