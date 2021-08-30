@extends('admin.admin-main')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>About</h4>
                    <br>
                    <div>
                        <a href="{{ route('add.about') }}"><button class="btn btn-info right">Add About</button> </a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">All Abouts</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="15%">Home Title</th>
                                <th scope="col" width="15%">Short Description</th>
                                <th scope="col" width="15%">Long Description</th>
                                <th scope="col" width="15%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($abouts as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $about->title }}
                                    <td> {{ $about->short_des }}
                                    <td> {{ $about->long_des }} </td>
                                    <td>
                                        <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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

