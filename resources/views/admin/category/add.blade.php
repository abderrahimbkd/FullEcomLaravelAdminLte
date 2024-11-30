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
                        <h1>Add New Category </h1>
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
                                        <label>Category Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="slug" placeholder="Enter Slug Ex.URL" required
                                            value="{{ old('slug') }}">
                                        <div style="color: red">{{ $errors->first('slug') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Image <span style="color: red"></span></label>
                                        <input type="file" class="form-control" name="image_name">

                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Button Name <span style="color: red"></span></label>
                                        <input type="text" class="form-control" name="button_name" placeholder="Enter Button Name">
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Home Screen <span style="color: red"></span></label>
                                        <input type="checkbox" style="display: block" name="is_home">
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Menu <span style="color: red"></span></label>
                                        <input type="checkbox" style="display: block" name="is_menu">
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Meta Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" required
                                            value="{{ old('meta_title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords" required
                                            value="{{ old('meta_keywords') }}">
                                    </div>

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
