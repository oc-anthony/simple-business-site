@extends('admin.admin-main')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Home Slider</h4>
                    <br>
                    <div>
                        <a href="{{ route('add.slider') }}"><button class="btn btn-info">Add Slider</button> </a>
                    </div>
                    <br>
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
                    <div class="card">
                        <div class="card-header">All Sliders</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="15%">Slider Title</th>
                                <th scope="col" width="15%">Slider Description</th>
                                <th scope="col" width="15%">Slider Image</th>
                                {{--                                <th scope="col">Created At</th>--}}
                                {{--                                <th scope="col">Updated At</th>--}}
                                <th scope="col" width="15%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- loop through categories --}}
                            @php($i = 1)
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $slider->title }}
                                    <td> {{ $slider->description }} </td>
                                    <td><img src="{{ asset($slider->image) }}" style="height: 40px; width: 70px" alt=""></td>
                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()

