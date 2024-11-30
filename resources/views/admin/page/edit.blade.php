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
                        <h1>Edit Page </h1>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label> Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $getRecord->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label> Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title"
                                            value="{{ $getRecord->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label> Image <span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="image">
                                        @if (!empty($getRecord->getImage()))
                                            <img src="{{ $getRecord->getImage() }}" width="200px">
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label> Description <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="description">{{ $getRecord->description }}</textarea>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label>Meta Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" required
                                            value="{{ old('meta_title', $getRecord->meta_title) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords" required
                                            value="{{ old('meta_keywords', $getRecord->meta_keywords) }}">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
