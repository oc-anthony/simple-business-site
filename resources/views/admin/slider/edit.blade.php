@extends('admin.admin-main')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @php
                    Session::forget('success')
                @endphp
            @endif
            <br>
            <div class="card-header card-header-border-bottom">
                <h2>Edit Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{ $slider->image }}">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Slider Title</label>
                        <input type="text"  name="title" class="form-control" value="{{ $slider->title }}" id="exampleFormControlInput1" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $slider->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Slider Image</label>
                        <input type="file" name="image" value="{{ $slider->image }}" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($slider->image) }}" style="width: 400px; height: 200px">
                    </div><br>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
