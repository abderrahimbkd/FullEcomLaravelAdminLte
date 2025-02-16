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
                        <h1>Category List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/category/add') }}" class="btn btn-primary">Add new category</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>image</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Meta Keywords</th>
                                            <th>Created By</th>
                                            <th>Home</th>
                                            <th>Menu</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->slug }}</td>
                                                <td>
                                                    @if (!empty($value->getImage()))
                                                        <img src="{{ $value->getImage() }}" style="height: 100px">
                                                    @endif
                                                </td>
                                                <td>{{ $value->meta_title }}</td>
                                                <td>{{ $value->meta_description }}</td>
                                                <td>{{ $value->meta_keywords }}</td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ $value->is_home == 1 ? 'Yes' : 'No ' }}</td>
                                                <td>{{ $value->is_menu == 1 ? 'Yes' : 'No ' }}</td>
                                                <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/category/edit/' . $value->id) }}" class="btn btn-primary">Edit </a>
                                                    <a href="{{ url('admin/category/delete/' . $value->id) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
@endsection
