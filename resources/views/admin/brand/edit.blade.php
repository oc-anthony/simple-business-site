@extends('admin.admin-main')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        @endif
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                <div class="mb-3">
                                    <label for="exampleInputBrand1" class="form-label">Update Brand</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputBrand1"
                                           aria-describedby="brandHelp" value="{{ $brand->brand_name }}">
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="exampleInputBrandImage1" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputBrandImage1"
                                           aria-describedby="brandHelp" value="{{ $brand->brand_image }}">
                                    @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($brand->brand_image) }}" style="width: 400px; height: 200px">
                                </div><br>

                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
