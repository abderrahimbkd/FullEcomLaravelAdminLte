@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders List Total:{{ $getRecord->total() }}</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts._message')

                        <form method="get">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Orders Search</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body  " style="overflow: auto">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" name="id" class="form-control" value="{{ Request::get('id') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" name="company_name" class="form-control" value="{{ Request::get('company_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" class="form-control" value="{{ Request::get('first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" class="form-control" value="{{ Request::get('last_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control" value="{{ Request::get('country') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control" value="{{ Request::get('city') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control" value="{{ Request::get('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Post Code</label>
                                                <input type="text" name="post_code" class="form-control" value="{{ Request::get('post_code') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" name="state" class="form-control" value="{{ Request::get('state') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="date" name="from_date" class="form-control" value="{{ Request::get('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="date" name="to_date" class="form-control" value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button class="btn btn-primary">Search</button>
                                            <a class="btn btn-primary" href="{{ url('admin/order/list') }}">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Number</th>
                                            <th>Name</th>
                                            <th>Compnay Name</th>
                                            <th>Country</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Post Code</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Discount Code </th>
                                            <th>Discount Amount ($)</th>
                                            <th>Shipping Amount ($)</th>
                                            <th>Total Amount ($)</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->first_name }}</td>
                                                <td>{{ $value->company_name }}</td>
                                                <td>{{ $value->country }}</td>
                                                <td>{{ $value->address_one }} {{ $value->address_two }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->state }}</td>
                                                <td>{{ $value->postcode }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->discount_code }}</td>
                                                <td>{{ number_format($value->discount_amount, 2) }}</td>
                                                <td>{{ number_format($value->shipping_amount, 2) }}</td>
                                                <td>{{ number_format($value->total_amount, 2) }}</td>
                                                <td>{{ $value->payment_method }}</td>
                                                <td>
                                                    <select class="form_control ChangeStatus" id="{{ $value->id }}" style="width: 150px">
                                                        <option {{ $value->status == 0 ? 'selected' : '' }} value="0">Pending</option>
                                                        <option {{ $value->status == 1 ? 'selected' : '' }} value="1">Inprogress</option>
                                                        <option {{ $value->status == 2 ? 'selected' : '' }} value="2">Delivered</option>
                                                        <option {{ $value->status == 3 ? 'selected' : '' }} value="3">Completed</option>
                                                        <option {{ $value->status == 4 ? 'selected' : '' }} value="4">Cancelled</option>

                                                    </select>
                                                </td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/order/detail/' . $value->id) }}" class="btn btn-primary">Detail </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px;float:right">
                                    {{ $getRecord->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('body').delegate('.ChangeStatus', 'change', function() {
            var status = $(this).val();
            var order_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/order_status') }}",
                data: {
                    status: status,
                    order_id: order_id,
                },
                dataType: 'json',
                success: function(data) {
                    alert(data.message);
                },
                error: function(data) {

                }
            });
        })
    </script>
@endsection
