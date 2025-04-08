<x-layouts.app>
    <div class="container mt-9">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-plain">
                    <div class="card-header text-start">
                        <h4 class="font-weight-bolder">Admin Sign Up</h4>
                        <p class="mb-0">Enter your name, email, and password to create your account</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.signup') }}">
                            @csrf
    
                            {{-- Name --}}
                            <div class="input-group input-group-outline mb-4">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
    
                            {{-- Email --}}
                            <div class="input-group input-group-outline mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
    
                            {{-- Password --}}
                            <div class="input-group input-group-outline mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
    
                            {{-- Terms Checkbox --}}
                            <div class="form-check form-check-info text-start ps-0 mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    I agree to the <a href="#" class="text-dark font-weight-bold">Terms and Conditions</a>
                                </label>
                            </div>
    
                            {{-- Submit --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg bg-gradient-primary w-100 mt-2">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1 mt-3">
                        <p class="mb-2 text-sm mx-auto">
                            Already have an account?
                            <a href="{{ route('admin.login') }}" class="text-primary font-weight-bold">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-layouts.app>
