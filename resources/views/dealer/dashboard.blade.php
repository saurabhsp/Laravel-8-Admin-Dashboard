<x-layouts.app>
    
    @if (session()->has('dealer_logged_by_user'))
    <form action="{{ route('dealer.back-to-user') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">Back to User</button>
    </form>    
    @endif
    <div class="container my-5 text-center">
        <h1>Hello {{ $dealer->name }}, Welcome</h1>
        <h4>Dealer Dashboard</h4>
        <p class="text-muted">Here is your ID card preview</p>

        <div class="id-card mt-4 mx-auto d-flex align-items-center gap-3 p-3 bg-light rounded shadow" style="width: 340px; height: 210px;">
            <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?ga=GA1.1.874864824.1719228024&semt=ais_hybrid&w=740" alt="Dealer Photo" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 2px solid #6c757d;">
            
            <div class="text-start">
                <h5 class="mb-1">{{ $dealer->name }}</h5>
                <small class="d-block"><strong>Email:</strong> {{ $dealer->email }}</small>
                <small class="d-block"><strong>Phone:</strong> {{ $dealer->phone }}</small>
                <p class="mt-2 text-success"><em>Thank you for being with us!</em></p>
            </div>
        </div>

        @if (!session()->has('dealer_logged_by_user'))
        <a class="btn btn-danger mt-4" href="{{ route('dealer.logout') }}">Logout Dealer</a>
    @endif
    
        </div>
</x-layouts.app>
