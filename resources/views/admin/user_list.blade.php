@extends('admin.maindesign')
@section('userlist')
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">User List</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td><a href="{{ route('admin.user.orders', $users->id) }}">
                                {{ $users->name }}
                    </a></td>
                <td>{{ $users->email }}</td>
                <td>
                    @if($users->user_type == 'admin')
                        <span class="badge bg-success">Admin</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
@endsection

