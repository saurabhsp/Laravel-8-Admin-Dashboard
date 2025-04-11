<x-layouts.app>

{{-- Prevent back button cache --}}
@php
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 1 Jan 2000 00:00:00 GMT"); 
@endphp


    <div class="container-fluid py-4">


        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white mx-3">
                                <strong>Dealer Management - See dealer, Add dealer, Manage dealer or Delete dealer
                                    Easily</strong>
                            </h6>
                        </div>
                    </div>

                    <div class="me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="{{ url('user/dealer/create') }}">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New dealer
                        </a>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID</th>
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
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dealers as $dealer)
                                        <tr>
                                            <td>
                                                <p class="mb-0 text-sm ms-3">{{ $dealer->id }}</p>
                                            </td>

                                            <td>
                                                <div>
                                                    <img src="{{ $dealer->profile_picture ? asset($dealer->profile_picture) : 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=' }}"
                                                        class="avatar avatar-sm me-3 border-radius-lg" alt="user">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                        <img src="{{ $dealer->profile_picture }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg"
                                                            alt="dealer">
                                                    </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $dealer->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs">{{ $dealer->email }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs">{{ $dealer->phone }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs">{{ $dealer->created_at->format('d M Y') }}</span>
                                            </td>



                                            <td class="align-middle text-center">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('user.dealers.edit', $dealer->id) }}">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <a href="{{ route('user.dealers.delete', $dealer->id) }}"
                                                    onclick="return confirm('Are you sure?')">
                                                    <button type="button" class="btn btn-danger btn-link">
                                                        <i class="material-icons" style="color: white">close</i>
                                                    </button>
                                                </a>
                                            </td>



                                            
                                            <td>                                                
                                                <form action="{{ route('user.login-as-dealer', $dealer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Login</button>
                                                </form>
                                            </td>


                                        </tr>
                                    @endforeach
                                    @if ($dealers->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No dealers found.
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
</x-layouts.app>
