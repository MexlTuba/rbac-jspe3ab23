@extends('mainLayout')

@section('page-title','Manage Users, Roles, and Permissions')

@section('page-content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <a href="{{ route('dash') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <h1 class="mt-3">Manage Users, Roles, and Permissions</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row mt-3">
        <div class="col-md-12">
            <h3>Assign Roles to Users</h3>
            <form action="{{ route('admin.assignRole') }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
                            @foreach($roles as $role)
                            <th>{{ $role->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }} ({{ $user->email }})</td>
                            @foreach($roles as $role)
                            <td>
                                <input type="checkbox" name="roles[{{ $user->id }}][]" value="{{ $role->id }}" @if($user->roles->contains($role->id)) checked @endif
                                >
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Assign Permissions to Roles</h3>
            <form action="{{ route('admin.assignPermission') }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Role</th>
                            @foreach($permissions as $permission)
                            <th>{{ $permission->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            @foreach($permissions as $permission)
                            <td>
                                <input type="checkbox" name="permissions[{{ $role->id }}][]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked @endif
                                >
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection