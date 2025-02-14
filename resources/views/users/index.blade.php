@extends('layouts.admin')

@section('main-content')
    <h1>Users</h1>
    <!-- <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a> -->
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <!-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a> -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @if($user->role === 'member')
                            <a href="{{ route('users.promote', $user->id) }}" class="btn btn-sm btn-success">Promote to Student</a>
                        @elseif($user->role === 'student')
                            <button class="btn btn-sm btn-secondary" disabled>Already Student</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
