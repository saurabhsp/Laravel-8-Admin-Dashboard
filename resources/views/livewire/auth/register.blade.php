<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                             style="background-image: url('{{ asset('assets/img/illustrations/illustration-signup.jpg') }}'); background-size: cover;">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain">
                            <div class="card-header">
                                <h4 class="font-weight-bolder">Sign Up</h4>
                                <p class="mb-0">Enter your name, email and password to register</p>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="register">
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" wire:model.lazy="name" class="form-control">
                                    </div>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" wire:model.lazy="email" class="form-control">
                                    </div>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" wire:model.lazy="password" class="form-control">
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="form-check form-check-info text-start ps-0">
                                        <input class="form-check-input" type="checkbox" id="termsCheck" checked>
                                        <label class="form-check-label" for="termsCheck">
                                            I agree to the <a href="#" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg bg-gradient-primary w-100 mt-4 mb-0">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="text-primary font-weight-bold">Sign in</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
