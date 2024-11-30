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
                        <h1>Add New Discount Code </h1>
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
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Discount Code Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Discount Code name" required
                                            value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Type <span style="color: red">*</span></label>
                                        <select class="form-control" name="type" required>

                                            <option value="Amount" {{ old('type') == 'amount' ? 'selected' : '' }}>Amount</option>
                                            <option value="Percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> Percent / Amount <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="percent_amount" placeholder="Enter Percent / Amount" required
                                            value="{{ old('percent_amount') }}">
                                    </div>

                                    <div class="form-group">
                                        <label> Expire Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" name="expire_date" required value="{{ old('expire_date') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <hr />


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
@endsection
