@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Order Details </h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Transaction Id:{{ $getRecord->transaction_id }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Name:{{ $getRecord->first_name }} {{ $getRecord->last_name }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Compnay Name:{{ $getRecord->first_name }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Country:{{ $getRecord->country }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Address:{{ $getRecord->adresse_one }}</label>
                                </div>
                                <div class="form-group">
                                    <label>City:{{ $getRecord->city }}</label>
                                </div>
                                <div class="form-group">
                                    <label>State:{{ $getRecord->state }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Post Code:{{ $getRecord->postcode }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Phone::{{ $getRecord->phone }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Email:{{ $getRecord->email }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Discount Code:{{ $getRecord->discount_code }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Discount Amount ($):{{ number_format($getRecord->discount_amount, 2) }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Shipping Amount ($): {{ $getRecord->getShipping->name }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Shipping Name ($):{{ number_format($getRecord->shipping_amount, 2) }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Total Amount ($):{{ number_format($getRecord->total_amount, 2) }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Payment Method:{{ $getRecord->payment_method }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Note:{{ $getRecord->note }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Status:@if ($getRecord->status == 0)
                                            Pending
                                        @elseif ($getRecord->status == 1)
                                            InProgress
                                        @elseif ($getRecord->status == 2)
                                            Delivred
                                        @elseif ($getRecord->status == 3)
                                            Completed
                                        @elseif ($getRecord->status == 4)
                                            Canceled
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Created Date:{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Size Name</th>
                                            <th>Color Name</th>
                                            <th>Size Amount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord->getItem as $item)
                                            @php
                                                $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                                            @endphp
                                            <tr>
                                                <td><img src="{{ $getProductImage->getLogo() }}" style="width:100px;height:100px;"></td>
                                                <td>
                                                    <a target="_blank" href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->size_name }}</td>
                                                <td>{{ $item->color_name }}</td>
                                                <td>{{ $item->size_amount }}</td>
                                                <td>{{ $item->total_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
@endsection
