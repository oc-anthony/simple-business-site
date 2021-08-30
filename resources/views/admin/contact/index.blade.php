@extends('admin.admin-main')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Contact</h4>
                    <br>
                    <div>
                        <a href="{{ route('add.contact') }}"><button class="btn btn-info right">Add Contact</button> </a>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">Contact Data</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="15%">Address</th>
                                <th scope="col" width="15%">Email</th>
                                <th scope="col" width="15%">Phone</th>
                                <th scope="col" width="15%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($contacts as $con)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $con->address }}</td>
                                    <td> {{ $con->email }}</td>
                                    <td> {{ $con->phone }}</td>
                                    <td>
                                        <a href="{{ url('contact/edit/'.$con->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('contact/delete/'.$con->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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

