@extends('admin.layouts.app')
@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}"> --}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Product </h1>
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
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Title" required
                                                    value="{{ old('title', $product->title) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SKU <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="sku" placeholder="Enter Sku" required
                                                    value="{{ old('sku', $product->sku) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category <span style="color: red">*</span></label>
                                                <select class="form-control" required name="category_id" id="ChangeCategory">
                                                    <option value="">Select</option>
                                                    @foreach ($getCategory as $category)
                                                        <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub Category <span style="color: red">*</span></label>
                                                <select class="form-control" name="sub_category_id" id="getSubCategory">
                                                    <option value="">Select</option>
                                                    @foreach ($getSubCategory as $subcategory)
                                                        <option {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">
                                                            {{ $subcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand <span style="color: red">*</span></label>
                                                <select class="form-control" name="brand_id">
                                                    <option value="">Select</option>
                                                    @foreach ($getBrand as $brand)
                                                        <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">
                                                            {{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Trendy product <span style="color: red"></span></label>
                                                <div>

                                                    <div>
                                                        <label><input {{ !empty($product->is_trendy) ? 'checked' : '' }} type="checkbox"
                                                                name="is_trendy"> </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Colors <span style="color: red">*</span></label>
                                                <div>
                                                    @foreach ($getColor as $color)
                                                        @php
                                                            $checked = '';
                                                        @endphp
                                                        @foreach ($product->getColor as $pcolor)
                                                            @if ($pcolor->color_id == $color->id)
                                                                @php
                                                                    $checked = 'checked';
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        <div>
                                                            <label><input {{ $checked }} type="checkbox" name="color_id[]"
                                                                    value="{{ $color->id }}">{{ $color->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price ($) <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="price" placeholder="Enter Price" required
                                                    value="{{ !empty($product->price) ? $product->price : '' }} ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Old Price ($) <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="old_price" placeholder="Enter Old Price" required
                                                    value="{{ !empty($product->old_price) ? $product->old_price : '' }} ">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sizes <span style="color: red">*</span></label>
                                                <div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price($)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="AppendSize">
                                                            @php
                                                                $i_s = 1;
                                                            @endphp
                                                            @foreach ($product->getSize as $size)
                                                                <tr id="DeleteSize{{ $i_s }}">
                                                                    <td>
                                                                        <input type="text" value="{{ $size->name }}"
                                                                            name="size[{{ $i_s }}][name]" placeholder="Name"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $size->price }}"
                                                                            name="size[{{ $i_s }}][price]" placeholder="Price"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" id="{{ $i_s }} " name=""
                                                                            class="btn btn-danger DeleteSize ">Delete </button>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i_s++;
                                                                @endphp
                                                            @endforeach

                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="size[100][name]" placeholder="Name"
                                                                        class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="size[100][price]" placeholder="Price"
                                                                        class="form-control">
                                                                </td>
                                                                <td>
                                                                    <button type="button" id=" " name=""
                                                                        class="btn btn-primary AddSize ">Add </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Image <span style="color: red">*</span></label>
                                                <input type="file" name="image[]" class="form-control" style="padding:3px" multiple
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                    @if (!empty($product->getImage->count()))
                                        <div class="row" id="sortable">
                                            @foreach ($product->getImage as $image)
                                                @if (!empty($image->getLogo()))
                                                    <div id="{{ $image->id }}" class="col-md-1 sortable_image" style="text-align: center ; ">
                                                        <img src="{{ $image->getLogo() }}" style="width: 100% ; height:100px" />
                                                        <a onclick="return confirm(' you want to delete?');"
                                                            href="{{ url('admin/product/image_delete/' . $image->id) }}" class="btn btn-danger btn-sm"
                                                            style="margin-top:10px">Delete</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif



                                    <hr />

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description <span style="color: red">*</span></label>
                                                <textarea name="short_description" class="form-control" placeholder="Short Description">{{ $product->short_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Description <span style="color: red">*</span></label>
                                                <textarea name="description" class="form-control editor" placeholder="Description">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Addition Information <span style="color: red">*</span></label>
                                                <textarea name="additional_information" class="form-control editor" placeholder="Addition Information">{{ $product->additional_information }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shipping Returns <span style="color: red">*</span></label>
                                                <textarea name="shipping_returns" class="form-control editor" placeholder="Shipping Returns">{{ $product->shipping_returns }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status <span style="color: red">*</span></label>
                                                <select class="form-control" name="status" required>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Active</option>
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
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
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
    <script src="{{ asset('sortable/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    })

                    $.ajax({
                        type: 'POST',
                        url: '{{ url('admin/product_image_sortable') }}',
                        data: {
                            'photo_id': photo_id,
                            '_token': "{{ csrf_token() }}"
                        },
                        datatype: 'json',
                        success: function(data) {



                        },
                        error: function(data) {

                        },
                    })
                }
            });
        })

        var i = 100;
        $('body').delegate('.AddSize', 'click', function() {
            i++;
            $("#AppendSize").append(
                '<tr id="DeleteSize' + i +
                '"><td><input type="text"  name="size[' + i +
                '][name]" placeholder="Name"  class="form-control"> </td><td><input type="text" placeholder="Price"  name="size[' + i +
                '][price]" class="form-control"></td> <td> <button type="button" id="' +
                i + '"  name="" class="btn btn-danger DeleteSize ">Delete </button></td></tr>'
            );
        });
        $('body').delegate('.DeleteSize', 'click', function() {
            var id = $(this).attr('id');
            $('#DeleteSize' + id).remove();
        })
        $('body').delegate('#ChangeCategory', 'change', function(e) {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/get_sub_category') }}',
                data: {
                    'id': id,
                    '_token': "{{ csrf_token() }}"
                },
                datatype: 'json',
                success: function(data) {

                    $('#getSubCategory').html(data.html.html);

                },
                error: function(data) {

                },
            })
        });
    </script>
@endsection
