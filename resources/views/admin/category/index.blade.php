@extends('admin.admin-main')

@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                @endif
                <br>
                <div class="card">
                    <div class="card-header">All Categories</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                            <td> {{ $category->category_name }} </td>
                            <td> {{ $category->user->name }} </td>
                            <td> {{ $category->created_at->diffForHumans() }} </td>
                            <td> {{ $category->updated_at->diffForHumans() }} </td>
                            <td>
                                <a href="{{ url('category/edit/'.$category->id ) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        <form action="{{ route('add.category') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputCategory1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputCategory1" aria-describedby="categoryHelp">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Trash List</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashCat as $category)
                        <tr>
                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                            <td> {{ $category->category_name }} </td>
                            <td> {{ $category->user->name }} </td>
                            <td> {{ $category->created_at->diffForHumans() }} </td>
                            <td> {{ $category->updated_at->diffForHumans() }} </td>
                            <td>
                                <a href="{{ url('category/restore/'.$category->id ) }}" class="btn btn-info">Restore</a>
                                <a href="{{ url('category/delete/'.$category->id) }}" class="btn btn-danger">Delete forever</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $trashCat->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
