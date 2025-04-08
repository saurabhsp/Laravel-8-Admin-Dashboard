
<nav
    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
    <div class="container-fluid ps-2 pe-0">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex flex-column" href="{{ route('dashboard') }}">
            GRIN Tech Task
            <span>Laravel CRUD </span>
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                        href="{{ route('dashboard') }}">
                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route('profile') }}">
                        <i class="fa fa-user opacity-6 text-dark me-1"></i>
                        Profile
                    </a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ in_array(request()->route()->getName(), ['register','login', 'password.forgot','reset-password']) ? route('register') : 'signup' }}">
                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Register
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ in_array(request()->route()->getName(), ['register','login', 'password.forgot','reset-password']) ? route('login') : 'login' }}">
                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                        Login
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                    <a href="#"
                        class="btn btn-sm mb-0 me-1 bg-gradient-dark" target="_blank">Any Queries?</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
