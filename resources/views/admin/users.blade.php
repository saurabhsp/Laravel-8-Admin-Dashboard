<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white mx-3">
                            <strong>User Management - See User, Add User, Manage User or Delete User Easily</strong>
                        </h6>
                    </div>
                </div>

                <div class="me-3 my-3 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="{{ url('admin/users/create') }}">
                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New User
                    </a>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Profile</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Created At</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <p class="mb-0 text-sm ms-3">{{ $user->id }}</p>
                                        </td>

                                        <td>
                                            <div>
                                                <img src="{{ $user->profile_picture ? asset($user->profile_picture) : 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=' }}"
                                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs">{{ $user->email }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs">{{ $user->phone }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs">{{ $user->created_at->format('d M Y') }}</span>
                                        </td>

                                        <td>
                                            @if ($user->status)
                                                <span class="badge bg-success">Active</span>
                                                <a href="{{ route('admin.users.toggle-status', $user->id) }}"
                                                    class="btn btn-sm btn-danger">Block</a>
                                            @else
                                                <span class="badge bg-danger">Blocked</span>
                                                <a href="{{ route('admin.users.toggle-status', $user->id) }}"
                                                    class="btn btn-sm btn-success">Unblock</a>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            <a rel="tooltip" class="btn btn-success btn-link"
                                                href="{{ route('admin.users.edit', $user->id) }}">
                                                <i class="material-icons">edit</i>
                                            </a>

                                            <a href="{{ route('admin.users.delete', $user->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <button type="button" class="btn btn-danger btn-link">
                                                    <i class="material-icons" style="color: white">close</i>
                                                </button>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                @if ($users->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No users found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">All Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Show Card</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filled by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function loadUsers() {
        fetch("{{ route('api.users') }}")
            .then(response => response.json())
            .then(data => {
                let tableBody = '';
                data.forEach(user => {
                    tableBody += `
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>
                                <a href="/user/card/${user.id}" target="_blank" class="btn btn-sm btn-warning">
                                    Show ID Card
                                </a>
                            </td>
                        </tr>
                    `;
                });
                document.querySelector('#userTable tbody').innerHTML = tableBody;
            })
            .catch(error => console.error('Error loading users:', error));
    }
</script>
