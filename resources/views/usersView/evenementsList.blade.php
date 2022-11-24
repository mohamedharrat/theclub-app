@extends('layouts.userspage')

@section('content')

@if (session('delete'))
<div class="alert alert-success">
    {{session('delete')}}
</div>  
@endif

@if (session('create'))
<div class="alert alert-success">
    {{session('create')}}
</div>  
@endif

@if (session('update'))
<div class="alert alert-success">
    {{session('update')}}
</div>
@endif
@if (session('inscription'))
<div class="alert alert-success">
    {{session('inscription')}}
</div>
@endif

@if (session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif 
<div class="header">
  <div class="left">

    <a class="addEvents"  href="{{route('userEvenements.create')}}"><i class="bi bi-plus-circle-fill"></i>  crée un événement</a>
    
    <form action="" method="get" id="date_filtre">
      @csrf
    </form>
  <br>
  <form action="" method="get" id="sport_filtre">
    <input type="date" name="date_filtre" id="date" min="" value="{{$date}}" >
    <button type="submit" class="" id="btn-filtre">filtre</button>
    
    <br>
    <br>
    <input type="radio" name="category" class="btn-check" id="foot" value="1" <?php echo $category == 1 ? "checked" : "" ?>>
    <label class="btn btn-outline-success" for="foot">Football</label>
    
    <input type="radio" name="category" class="btn-check" id="tennis" value="2" <?php echo $category == 2 ? "checked" : "" ?>>
    <label class="btn btn-outline-warning" for="tennis">Tennis</label>
    
    <input type="radio" name="category" class="btn-check" id="basket" value="3"<?php echo $category == 3 ? "checked" : "" ?>>
    <label class="btn btn-outline-danger" for="basket">Basket</label>
    
    <button class="btn btn-dark" 
    onclick="document.getElementById('foot').value = '' 
    document.getElementById('tennis').value = '' 
    document.getElementById('basket').value = '' 
    ">
    RESET
  </button>
  <br>
  <br>
  <label for="region" class="text-light">Région</label>
  <select class="custom-select bg bg-dark text-light" name="region_filtre" id="region">
    @foreach ($regions as $region)
    <option value="{{$region->name}}">{{$region->name}}</option>
    @endforeach
  </select>
</form>
</div>

<div class="right">
  <h3>THE CLUB</h3>
<p>Bienvenue à THE CLUB , <br> 
tu te trouve à l'accueil là où 
tu pourra tout gérer, de le création à la participation
d'événements . tu à également accès au chat et ton profil.
tiens toi informé des dernières actualités en consultant nos différent réseau :
</p>
<div class="logo">
  <ul>
    <li>
      <a href="#"><i class="bi bi-twitter"></i></a>
    </li>
    <li>
      <a href="#"><i class="bi bi-facebook"></i></a>
    </li>
    <li>
      <a href="#"><i class="bi bi-instagram"></i></a>
    </li>
    <li>
      <a href="#"><i class="bi bi-youtube"></i></a>
    </li>
  </ul>
</div>
</div>

{{-- <a href=""></a> --}}
</div>
<div class="list">
  {{$userEvenements->links()}}

  @foreach ($userEvenements as $userEvenement)
  
      <div class="evenement" id="evenement">
    @if ($userEvenement->category->name == "tennis")
    <div class="heure" id="heure" style="background: url('/photo-event/tennis.jpg')center/cover">
      <h2>{{$userEvenement->heure}}</h2> 
    </div>
    @elseif($userEvenement->category->name == 'basket')
    <div class="heure" id="heure" style="background: url('/photo-event/basket.jpg')center/cover">
      <h2>{{$userEvenement->heure}}</h2> 
    </div>
    @else
    <div class="heure" id="heure" style="background: url('/photo-event/foot.jpg')center/cover">
      <h2>{{$userEvenement->heure}}</h2> 
        </div>
        @endif
        <div class="info">
          @if ($userEvenement->players_number == 0)
              
          <p class="nbr bg bg-danger p-2">complet</p>
          @else
          <p class="nbr">{{$userEvenement->players_number}}-place</p>
          @endif
          <h3 id="category">{{$userEvenement->category->name}}</h3>
          <p>
            {{$userEvenement->city}}-{{$userEvenement->lieu}} 
          </p>
          <p>durée - {{$userEvenement->duree}} h</p>
        </div>
        <div class="fav">
          <a href="{{route('userEvenements.like',['id' => $userEvenement->id])}}" class="btn btn-danger"> 
            @if ($userEvenement->isLiked())
            <i class="bi bi-suit-heart-fill"></i>
            @else
            <i class="bi bi-suit-heart"></i>
            @endif
            {{$userEvenement->likes()->count()}}
          </a>
        </div>
        <div class="show">

          <a href="{{route('userEvenements.show', ['userEvenement'=>$userEvenement->id]) }}"><i class="bi bi-zoom-in"></i></a>
          @if (Auth::user()->id == $userEvenement->author_id)
              
          <a href="{{route('userEvenements.edit',['userEvenement'=>$userEvenement->id])}}" style="text-decoration: none">
            <i class="bi bi-pencil-square px-1"></i>
          </a>
          <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet événement?')){document.getElementById('delete-{{$userEvenement->id}}').submit()}" style="text-decoration: none">
            <i class="bi bi-trash px-1"></i>
          </a>  
          <form id="delete-{{$userEvenement->id}}" action="{{route('userEvenements.destroy',['userEvenement'=>$userEvenement->id])}}" method="post">
            @csrf
            @method('delete')
          </form>
          @endif
        </div>
      </div>
      
      
      @endforeach
    </div>

    
      {{-- <div>
    <x-nav-user/>
  </div> --}}
  @endsection