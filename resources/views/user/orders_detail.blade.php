@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Order Details</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->


        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <br>
                    <br>
                    <div class="row">
                        @include('user.sidebare')

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                @include('admin.layouts._message')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label style="font-weight: bold"> Id:{{ $getRecord->order_number }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label style="font-weight: bold">Name:{{ $getRecord->first_name }} {{ $getRecord->last_name }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Compnay Name:{{ $getRecord->first_name }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Country:{{ $getRecord->country }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Address:{{ $getRecord->adresse_one }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">City:{{ $getRecord->city }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">State:{{ $getRecord->state }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Post Code:{{ $getRecord->postcode }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Phone::{{ $getRecord->phone }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Email:{{ $getRecord->email }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Discount Code:{{ $getRecord->discount_code }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Discount Amount ($):{{ number_format($getRecord->discount_amount, 2) }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Shipping Amount ($): {{ $getRecord->getShipping->name }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Shipping Name ($):{{ number_format($getRecord->shipping_amount, 2) }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Total Amount ($):{{ number_format($getRecord->total_amount, 2) }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Payment Method:{{ $getRecord->payment_method }}</label>
                                    </div>
                                    <div class="form-group">
                                        <labe style="font-weight: bold"l>Note:{{ $getRecord->note }}</labe>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-weight: bold">Status:@if ($getRecord->status == 0)
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
                                        <label style="font-weight: bold">Created
                                            Date:{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</label>
                                    </div>
                                </div>

                                <div class=" " style="margin-top: 20px">
                                    <div class="card-header" style="margin-top: 20px">
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
                                                            <a target="_blank"
                                                                href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                            <br>
                                                            @if (!empty($item->color_name))
                                                                <b>Color Name:</b>{{ $item->color_name }}<br>
                                                            @endif
                                                            @if (!empty($item->color_name))
                                                                <b>Size Name:</b>{{ $item->size_name }}<br>
                                                            @endif

                                                            <br>
                                                            @if ($getRecord->status == 3)
                                                                @php
                                                                    $getReview = $item->getReview($item->getProduct->id, $getRecord->id);
                                                                @endphp
                                                                @if (!empty($getReview))
                                                                    <b>Star :</b> {{ $getReview->rating }}<br>
                                                                    <b>Review</b> {{ $getReview->review }}<br>
                                                                @else
                                                                    <button class="btn btn-primary MakeReview" id="{{ $item->getProduct->id }}"
                                                                        data-order="{{ $getRecord->id }}">Make Review</button>
                                                                @endif
                                                            @endif
                                                        </td>


                                                        <td>{{ $item->quantity }} $</td>
                                                        <td>{{ $item->price }} $</td>
                                                        <td>{{ $item->size_amount }} $</td>
                                                        <td>{{ $item->total_price }} $</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

    <!-- Modal -->
    <div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('user/makeReview') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" id="getProductId" required>
                    <input type="hidden" name="order_id" id="getOrderId" required>
                    <div class="modal-body" style="padding: 20px">
                        <div class="form-group">
                            <label>How Many Star?</label>
                            <select class="form-control" required name="rating">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Review</label>
                            <textarea class="form-control" required name="review"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('body').delegate('.MakeReview', 'click', function() {
            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');

            $('#getProductId').val(product_id);
            $('#getOrderId').val(order_id);
            $('#MakeReviewModal').modal('show');
        })
    </script>
@endsection
