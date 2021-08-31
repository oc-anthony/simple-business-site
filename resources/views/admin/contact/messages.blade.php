@extends('admin.admin-main')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Messages</h4>
                    <br>
                    <div class="card">
                        <div class="card-header">Messages</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($messages as $msg)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $msg->name }}</td>
                                    <td> {{ $msg->email }}</td>
                                    <td> {{ $msg->subject }}</td>
                                    <td> {{ $msg->message }}</td>
                                    <td> {{ $msg->created_at->diffForHumans() }} </td>
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

