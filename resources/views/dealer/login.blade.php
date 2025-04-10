<x-layouts.app>
    <div class="container my-auto mt-5">
        <div class="row signin-margin">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Dealer Login</h4>
                            <div class="row mt-3">
                                <h6 class='text-white text-center'>
                                    <span class="font-weight-normal"></span>Login with your Credentials<br>
                                </h6>
                                <div class="col-2 text-center ms-auto">
                                    <a class="btn btn-link px-3" href="#">
                                        <i class="fa fa-facebook text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center px-1">
                                    <a class="btn btn-link px-3" href="#">
                                        <i class="fa fa-github text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center me-auto">
                                    <a class="btn btn-link px-3" href="#">
                                        <i class="fa fa-google text-white text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('dealer.login') }}">
                            @csrf

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ session('error') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="input-group input-group-outline mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            @error('email')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror

                            <div class="input-group input-group-outline mt-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            @error('password')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror

                            <div class="form-check form-switch d-flex align-items-center my-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                            </div>

                            <p class="mt-4 text-sm text-center">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Register</a>
                            </p>

                            <p class="text-sm text-center">
                                Forgot your password? Reset it
                                <a href="{{ route('password.forgot') }}" class="text-primary text-gradient font-weight-bold">here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
```