@extends('admin.admin-main')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h4>Update</h4>
                <br>
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputCategory1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputCategory1"
                                       aria-describedby="categoryHelp" value="{{ $category->category_name }}">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

