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
                        <h1>Add New Slider </h1>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">


                                    <div class="form-group">
                                        <label> Title <span style="color: red"></span></label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" 
                                            value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label> Image <span style="color: red">*</span></label>
                                        <input type="file" class="form-control" required name="image_name">
                                    </div>
                                    <div class="form-group">
                                        <label> Button Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="button_name" value="{{ old('button_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label> Button Link <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="button_link" value="{{ old('button_link') }}">
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
