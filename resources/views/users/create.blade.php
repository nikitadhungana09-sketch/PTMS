<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

    <h2>Create User</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name" class="form-control mb-2">

        <input type="email" name="email" placeholder="Email" class="form-control mb-2">

        <input type="password" name="password" placeholder="Password" class="form-control mb-2">

        <select name="role" class="form-control mb-2">
            <option value="admin">Admin</option>
            <option value="branch_employee">Branch Employee</option>
            <option value="support_technician">Support Technician</option>
            <option value="department_supervisor">Department Supervisor</option>
            <option value="management">Management</option>
        </select>

        <button class="btn btn-success">Create</button>
    </form>

</div>