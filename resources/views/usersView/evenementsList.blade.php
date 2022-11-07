@extends('layouts.userspage')

@section('content')
<form action="" method="get" id="date_filtre">
  @csrf
</form>
<br>
<form action="" method="get" id="sport_filtre">
  <input type="date" name="date_filtre" id="date" min="" value="{{$date}}" >
  <button type="submit" class="btn btn-light">filtre</button>

<br>
<br>
<input type="radio" name="category" class="btn-check" id="foot" value="1" <?php echo $category == 1 ? "checked" : "" ?>>
<label class="btn btn-outline-success" for="foot">Football</label>

<input type="radio" name="category" class="btn-check" id="tennis" value="2" <?php echo $category == 2 ? "checked" : "" ?>>
<label class="btn btn-outline-warning" for="tennis">Tennis</label>

<input type="radio" name="category" class="btn-check" id="basket" value="3"<?php echo $category == 3 ? "checked" : "" ?>>
<label class="btn btn-outline-danger" for="basket">Basket</label>
<br>
</form>
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

@if (session('compteUpdate'))
<div class="alert alert-success">
    {{session('compteUpdate')}}
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
{{-- <a href=""></a> --}}
<a class="addEvents"  href="{{route('userEvenements.create')}}"><i class="bi bi-plus-circle-fill"></i>  crée un événement</a>
<div class="list">
  {{-- {{$evenements->links()}} --}}

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
          <p class="nbr">{{$userEvenement->players_number}}-place</p>
          <h3 id="category">{{$userEvenement->category->name}}</h3>
          <p>
            {{$userEvenement->lieu}} - {{$userEvenement->adresse}}
          </p>
          <p>durée - {{$userEvenement->duree}} h</p>
        </div>
        <div class="fav">
          <input  type="checkbox" name="favorie" class="btn-check" id="favorie" >
          <label class="btn btn-outline-danger" for="favorie"><i class="bi bi-suit-heart-fill">3</i></label>
        </div>
        <div class="show">

          <a href="{{route('userEvenements.show', ['userEvenement'=>$userEvenement->id]) }}"><i class="bi bi-zoom-in"></i></a>
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
        </div>
      </div>
      
      
      @endforeach
    </div>

    
      {{-- <div>
    <x-nav-user/>
  </div> --}}
  @endsection