@extends('layouts.dashboard')

@section('content')
@if ($results->count() == 0)
<div class="alert alert-danger">
    <h3>Aucun résultat  trouvé!</h3>
</div>
@else
<div class="alert alert-success">
<h3> {{$results->count()}} résultat(s)  trouvé(s)!</h3>
</div>
@endif

@foreach ($results as $evenement)
<div class="evenement">
    @if ($evenement->category->name == "tennis")
    <div class="heure" id="heure" style="background: url('/photo-event/tennis.jpg')center/cover">
      <h2>{{$evenement->heure}}</h2> 
    </div>
    @elseif($evenement->category->name == 'basket')
    <div class="heure" id="heure" style="background: url('/photo-event/basket.jpg')center/cover">
      <h2>{{$evenement->heure}}</h2> 
    </div>
    @else
    <div class="heure" id="heure" style="background: url('/photo-event/foot.jpg')center/cover">
      <h2>{{$evenement->heure}}</h2> 
        </div>
        @endif
        <div class="info">
          <p class="nbr">{{$evenement->players_number}}-place</p>
          <h3 id="category">{{$evenement->category->name}}</h3>
          <p>
            {{$evenement->lieu}} - {{$evenement->adresse}}
          </p>
          <p>durée - {{$evenement->duree}} h</p>
        </div>
        <div class="show">
            <a href="{{route('evenements.edit',['evenement'=>$evenement->id])}}" style="text-decoration: none">
                <i class="bi bi-pencil-square px-1"></i>
            </a>
            <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet événement?')){document.getElementById('delete-{{$evenement->id}}').submit()}" style="text-decoration: none">
                <i class="bi bi-trash px-1"></i>
            </a>  
            <form id="delete-{{$evenement->id}}" action="{{route('evenements.destroy',['id'=>$evenement->id])}}" method="post">
                @csrf
                @method('delete')
            </form>
          {{-- <a href="{{route('userEvenements.show', ['userEvenement'=>$evenement->id]) }}"><i class="bi bi-zoom-in"></i></a> --}}
        </div>
      </div>
      
@endforeach
@endsection