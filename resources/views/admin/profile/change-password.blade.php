@extends('admin.admin-main')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.password') }}" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Current Password</label>
                    <input type="password" name="oldpassword" class="form-control" placeholder="Current Password">
                    @error('oldpassword')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="New Password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-dark">Save</button>
            </form>
        </div>
    </div>

@endsection
