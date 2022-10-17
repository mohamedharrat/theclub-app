@extends('layouts.userspage')

@section('content')
<form action="" method="get" id="date_filtre">
  @csrf
  <input type="date" name="date_filtre" id="date" min="" onchange="document.getElementById('date_filtre').submit();" >
  <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off" name="foot">
<label class="btn btn-outline-success" for="btn-check-outlined">Football</label>
</form>
@if (session('delete'))
<div class="alert alert-success">
    {{session('delete')}}
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
<div class="alert alert-success">
    {{session('error')}}
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif 
{{-- <a href=""></a> --}}
<a class="addEvents"  href="{{route('userEvenements.create')}}"><i class="bi bi-plus-circle-fill"></i>  Add Evenements</a>
<div class="list">
  {{-- {{$evenements->links()}} --}}

  @foreach ($userEvenements as $userEvenement)
      <div class="evenement">
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