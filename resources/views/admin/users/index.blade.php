@extends('layouts.admin')
@section('content')
    @include('includes.toast_message')
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
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $users->links() }}
        </div>
    </div>
@endsection