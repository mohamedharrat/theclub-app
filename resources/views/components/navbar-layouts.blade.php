<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/navbar-layouts.css')}}" />

</head>
<body>
    <div class="navbar-layouts">

        @if (Route::has('login'))
        <div class="" >
            @auth
            
            
            {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a> --}}
            <nav class="">
                <div class="nav-nav">  
                    
                    <p class="p-nav">{{ Auth::user()->name }} : connecté</p>
                    <div class="nav-1">

                        @if (Auth::user()->role =='admin')
                        <a href="{{route('dashboard')}}" class="a-nav">dashboard</a>
                        
                        @else
                        
                        <a href="{{ route('userEvenements.index') }}" class="a-nav">Home</a>
                        @endif
                        
                        
                        <a class="a-nav" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Déconnexion') }}
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    </nav>
    
    @else
    <a href="{{ route('login') }}" class="btn-login" id="button">Log in</a>
    
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="btn-register" id="button">Register</a>
    @endif
    @endauth
</div>
@endif
</div>
</body>
</html>
