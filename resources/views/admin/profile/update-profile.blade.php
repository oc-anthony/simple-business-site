@extends('admin.admin-main')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update Profile</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.profile') }}" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>
                <button type="submit" class="btn btn-primary btn-dark">Save</button>
            </form>
        </div>
    </div>

@endsection
