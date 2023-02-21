<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('users.home') }}"><button class="btn btn-primary btn-sm mb-4"><i
                            class="bi bi-arrow-left me-2"></i>Kembali</button></a>
                <h3>Trash</h3>
                <p class="text-subtitle text-muted">Berikut data yang masuk trash</p>
            </div>
        </div>
    </x-slot>

    <div class="card">
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
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role }}</td>
                        <td class="d-flex">
                            <form action="{{ url('/user/' . $item->id . '/force-delete') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger me-2"><i
                                        class="bi bi-trash-fill me-2"></i>Delete
                                    Permanent</button>
                            </form>
                            <form action="{{ url('/user/' . $item->id . '/restore') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning"><i
                                        class="bi bi-arrow-repeat me-2"></i>Restore</button>
                            </form>
                        </td>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
