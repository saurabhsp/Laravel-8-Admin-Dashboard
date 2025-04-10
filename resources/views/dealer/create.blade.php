<x-layouts.app>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-gradient-primary text-white rounded-top-4">
                        <h4 class="mb-0" style="color: rgb(228, 228, 228)">Create New Entry</h4>
                    </div>
                    <div class="card-body">
                        {{-- Start your form here --}}
                        <form action="{{ route('user.dealers.store') }}" method="POST">
                            @csrf

                            {{-- Add your form fields below --}}
                            {{-- Name --}}
                            <div
                                class="input-group input-group-outline mt-3 @if (strlen($name ?? '') > 0) is-filled @endif">
                                <label class="form-label"><i class="fas fa-user"></i>Name</label>
                                <input name='name' type="text" class="form-control">
                            </div>

                            {{-- Email --}}
                            <div
                                class="input-group input-group-outline mt-3 @if (strlen($email ?? '') > 0) is-filled @endif">
                                <label class="form-label"><i class="fas fa-envelope"></i>Email</label>
                                <input name='email' type="email" class="form-control">
                            </div>

                            {{-- Phone --}}
                            <div
                                class="input-group input-group-outline mt-3 @if (strlen($phone ?? '') > 0) is-filled @endif">
                                <label class="form-label"><i class="fas fa-phone"></i>Mobile Number</label>
                                <input name='phone' type="text" maxlength="10" class="form-control">
                            </div>

                            {{-- Password --}}
                            <div
                                class="input-group input-group-outline mt-3 @if (strlen($password ?? '') > 0) is-filled @endif">
                                <label class="form-label"><i class="fas fa-lock"></i>Password</label>
                                <input name='password' type="password" class="form-control">
                            </div>

                            <div class="m-3">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </form>
                        {{-- End form --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
