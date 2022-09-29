@if (Route::has('login'))
<div class="" style="margin-bottom: 20px">
    @auth
    
    
        {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }}
      </a> --}}
<nav class="">
    <div class=""> 
          <p class="">THE CLUB</p>
          <p class="p-nav">{{ Auth::user()->name }} : {{Auth::user()->role}}</p>
          @if (Auth::user()->role =='admin')
          <a href="#" class="a-nav">dashboard</a>
          
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
</nav>
    
    @else
        <a href="{{ route('login') }}" class="btn-login" id="button">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-register" id="button">Register</a>
        @endif
    @endauth
</div>
@endif