@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Edit Profile</h1>
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
                                <form action="" method="post" id=" ">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" name='first_name' class="form-control" required value="{{ $getRecord->name }}">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" required value="{{ $getRecord->last_name }}">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                    <label>Email address *</label>
                                    <input type="email" name="email" class="form-control" required value="{{ $getRecord->email }}">
                                    <label>Company Name (Optional)</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ $getRecord->company_name }}">

                                    <label>Country *</label>
                                    <input type="text" name="country" class="form-control" required value="{{ $getRecord->country }}">

                                    <label>Street address *</label>
                                    <input type="text" class="form-control" name="address_one" placeholder="House number and Street name" required
                                        value="{{ $getRecord->address_one }}">
                                    <input type="text" class="form-control" name="address_two" placeholder="Appartments, suite, unit etc ..." required
                                        value="{{ $getRecord->address_two }}">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" name="city" class="form-control" required value="{{ $getRecord->city }}">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>State *</label>
                                            <input type="text" name="state" class="form-control" required value="{{ $getRecord->state }}">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" name="postcode" class="form-control" required value="{{ $getRecord->postcode }}">
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" name="phone" class="form-control" required value="{{ $getRecord->phone }}">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" style="width: 100px">
                                        Submit
                                    </button>

                                </form>

                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
@section('script')
@endsection
