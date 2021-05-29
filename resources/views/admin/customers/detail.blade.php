@extends('admin.layout')
@section('content')

    @php
    $referred_users = DB::table('users')
        ->where('referred_by', $data['customers']->id)
        ->get();
    $customer = $data['customers'];

    $addresses = DB::table('address_book')
        ->where('user_id', $customer->id)
        ->get();

    $point_log = DB::table('reward_point_logs')
        ->where('user_id', $customer->id)
        ->get();
    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.EditCustomers') }} <small>{{ trans('labels.EditCurrentCustomers') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
                        {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/customers/display') }}"><i class="fa fa-users"></i>
                        {{ trans('labels.ListingAllCustomers') }}</a></li>
                <li class="active">{{ trans('labels.EditCustomers') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Customer Detail</h3>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{ asset($customer->avatar ?: '/web/images/default-avatar.png') }}"
                                                alt="" style="width: 100%">
                                        </div>
                                        <div class="col-sm-4">
                                            <h1>{{ $customer->first_name }} {{ $customer->last_name }}</h1>
                                            <h4><strong>User Registered:
                                                </strong>{{ Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}
                                            </h4>
                                            <br>
                                            <h3><strong>Email Address : </strong>{{ $customer->email }}</h3>
                                            <h3><strong>Contact Number : </strong>{{ $customer->phone }}</h3>
                                            <h3><strong>Reward Points: </strong>{{ $customer->reward_points }}</h3>

                                            <a href="/admin/customers/edit/{{ $customer->id }}"
                                                class="btn btn-default">Edit Details</a>
                                        </div>
                                        <div class="col-sm-5">
                                            <h2>Address Book</h2>
                                            @forelse($addresses as $address_data)
                                                <h3>
                                                    {{ $address_data->entry_firstname }},
                                                    {{ $address_data->entry_lastname }},
                                                    {{ $address_data->entry_street_address }},
                                                    {{ $address_data->entry_city }}, {{ $address_data->entry_postcode }}
                                                </h3>
                                            @empty
                                                <div class="text-center">
                                                    <h3 style="margin-top: 40px">No Address Added!!</h3>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Reward Point Logs</h3>

                        </div>

                        <div class="box-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($point_log as $key => $point)
                                 <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ $point->remarks }}</td>
                                 </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Referred Users </h3>
                        </div>

                        <div class="box-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Added On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($referred_users as $key => $referred_user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $referred_user->first_name }} {{ $referred_user->last_name }}</td>
                                            <td>{{ $referred_user->email }}</td>
                                            <td>{{ Carbon\Carbon::parse($referred_user->created_at)->diffForHumans() }}
                                            </td>
                                            <td><a href="/admin/customers/edit/{{ $referred_user->id }}"
                                                    class="btn btn-sm btn-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
