<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Management</h3>
                <p class="text-subtitle text-muted">Fitur Soft Delete sudah tersedia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>Users Data</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add User
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('users.create') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="Your Name"
                                    required>
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control mb-2" placeholder="Username"
                                    required>
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                                    required>
                                <label for="select" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                                    required>
                                <label for="select" class="form-label">Role User</label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert mt-1 alert-success text-center alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check text-success"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert mt-1 alert-danger text-center alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check text-success"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($users as $item)
                    <tbody>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}@if (Auth::user()->id == $item->id)
                                (Loged In)
                            @endif
                        </td>
                        <td>{{ $item->role }}</td>
                        <td class="d-flex">
                            @if (Auth::user()->id == $item->id)
                            @else
                                <form action="{{ url('/user/' . $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="bi bi-trash-fill"></i></button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#model{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="model{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/user/' . $item->id) }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control mb-2"
                                                placeholder="Your Name" required value="{{ $item->name }}">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control mb-2"
                                                placeholder="Username" required value="{{ $item->username }}">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control mb-2"
                                                placeholder="Email" required value="{{ $item->email }}">
                                            <label for="select" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control mb-2"
                                                placeholder="Password" required value="{{ $item->password }}">
                                            <label for="select" class="form-label">Role User</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="role">
                                                <option value="admin" {{ $item->role == 'admin' ? 'Selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="user" {{ $item->role == 'user' ? 'Selected' : '' }}>
                                                    User
                                                </option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tbody>
                @endforeach
            </table>
            <a href="{{ route('users.trash') }}"><button class="btn btn-danger btn-sm"><i
                        class="bi bi-trash-fill me-2"></i>View Trash</button></a>
        </div>
    </div>
</x-app-layout>
