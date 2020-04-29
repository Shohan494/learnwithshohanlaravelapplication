@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="d-inline-block">Users List</h4>
                            <a href="{{ route('users.create') }}" class="btn btn-info float-right">Add A New User</a>
                        </div>
                    </div>
                    <div class="card-body">
                            @include('flash.message')
                            @if(count($users))
                            <table class="table table-bordered">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Name</th>
                                    <th width="30%">Email</th>
                                    <td width="15%">Created</td>
                                    <th width="20%">Action</th>
                                </tr>

                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="" onclick="event.preventDefault(); document.getElementById('form-{{ $user->id }}').submit()" class="btn btn-sm btn-danger">Delete</a>
                                            <form id="form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post"> @csrf @method("DELETE")</form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">{{ $users->links() }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                                {{ "No users available" }}
                            @endif
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection