@extends('layouts.admin')
@section('content')
    @if(Session::has('toastMessage'))
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session('toastMessage') }}
        </div>
    @endif
    <h1>Users</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td class="text-center"><img src="{{ $user->photo_id ? $user->photo->path : $placeholder }}" height="50px" class="img-rounded"></td>
                <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role_id ? $user->role->name : 'N/A' }}</td>
                <td>{{ $user->is_active ? "Active" : "Not Active" }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection