@extends('admin/adminMaster')
@section('title', 'Users')
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Users</li>
</ol>
@endsection
@section('content')
<div class="container">
    <h1 class="text-white">Users</h1>

    @if(\App\Helpers\RoleHelper::hasRole('admin'))
    <div class="row" bis_skin_checked="1">
        <div class="col-md-12 text-start my-3" bis_skin_checked="1">
            <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Add User</a>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center text-center mb-0" id="userTable">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder  ps-2">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Role</th>
                                    @if(\App\Helpers\RoleHelper::hasRole('admin'))
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($users as $index => $user)
                                <tr>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name ?? 'N/A' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email ?? 'N/A' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($user->role ?? 'N/A') }}</span>
                                    </td>

                                    @if(\App\Helpers\RoleHelper::hasRole('admin'))
                                    <td class="align-middle">
                                        <a class="btn btn-link text-success px-3 mb-0 edit-btn"
                                            href="javascript:;"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-pencil-alt text-success me-2" aria-hidden="true"></i>Edit
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-danger px-3 mb-0"
                                                onclick="return confirm('Are you sure?')"
                                                style="border: none; background: none;">
                                                <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    {{ $users->links() }}

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="userForm" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="userId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                @foreach (\App\Helpers\RoleHelper::getRoles() as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="passwordField">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="userEditForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="userId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="editRole" class="form-control" required>
                                @foreach (\App\Helpers\RoleHelper::getRoles() as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000, // Duration in milliseconds
            gravity: "top", // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Background color
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@endsection