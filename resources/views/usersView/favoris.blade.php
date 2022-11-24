@extends('layouts.userspage')

@section('content')
<div class="list">
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
    {{-- {{$evenements->links()}} --}}
    <div class="favoris">

        <h1 class="titre">Mes Favoris</h1>
        @foreach (Auth::user()->likes as $userEvenement)
        @if ($userEvenement->date >= date('Y-m-d'))
            
        
        <div class="evenement" id="mes-evenement">
            <h6 class=" text-center text-light p-1">{{$userEvenement->date}}</h6>
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
            
            <p class="nbr bg bg-danger p-2">évènement victime de son succès</p>
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
    @else
    <h4 class="text-light">aucun événement favoris</h4>
    @endif
    @endforeach
</div>


@endsection