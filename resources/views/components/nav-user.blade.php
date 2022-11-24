
<div class="nav-info">
    <a href="{{ route('userEvenements.index') }}">
      <i class="bi bi-house-door-fill"></i>
      <p>Accueil</p>
    </a>
   
    <a href="{{route('mesEvenements')}}">
      <i class="bi bi-calendar-date-fill"></i>
       <p> mes événements</p>
    </a>
  
   
    <a href="{{route('favoris')}}">
      <i class="bi bi-calendar-heart-fill"></i>
      <p>Favoris</p>
    </a>
    <a href="/chatify">
      <i class="bi bi-chat"></i>
      <p>Chat</p>
    </a>
    <a href="/profil">
      <i class="bi bi-person-circle"></i>
      <p>Profil</p>
    </a>
    <a href="{{route('aideAdmin.create')}}">
      <i class="bi bi-question-circle"></i>
      <p>Aide</p>
    </a>
  </div>