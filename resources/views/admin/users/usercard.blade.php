<x-layouts.app>
    <style>
        .flip-card {
            background-color: transparent;
            width: 300px;
            height: 200px;
            perspective: 1000px;
            margin: 40px auto;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .flip-card-front {
            background-color: orange;
            color: white;
        }

        .flip-card-front img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .flip-card-back {
            background-color: #fff;
            color: #333;
            transform: rotateY(180deg);
            padding: 15px;
            text-align: center;
        }

        .flip-card-back img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            margin-top: -12px;
        }
    </style>

    <div class="flip-card">
        <div class="flip-card-inner">
            <!-- Front of the card -->
            <div class="flip-card-front">
                <img src="https://randomuser.me/api/portraits/lego/1.jpg" alt="Random Avatar">
                <h3>User ID: {{ $user->id }}</h3>
            </div>
            <!-- Back of the card -->
            <div class="flip-card-back">
                <h3>{{ $user->name }}   <h4>{{$user->phone}}</h4>  <img src="https://static.vecteezy.com/system/resources/previews/009/317/578/non_2x/remote-work-icon-logo-illustration-employee-symbol-template-for-graphic-and-web-design-collection-free-vector.jpg">   
                </h3>
            </div>
        </div>
    </div>
</x-layouts.app>
