<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

    <h2>Users</h2>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Create User</a>

    <table class="table table-bordered">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
        @endforeach

    </table>

</div>