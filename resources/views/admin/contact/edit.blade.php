@extends('admin.admin-main')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('contact/update/'.$contact->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email"  name="email" value="{{ $contact->email }}"class="form-control" id="exampleFormControlInput1" placeholder="Email">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <input type="text"  name="phone" value="{{ $contact->phone }}" class="form-control" id="exampleFormControlInput1" placeholder="Phone">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3">{{ $contact->address }}                        </textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
