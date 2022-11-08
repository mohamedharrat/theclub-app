@extends('layouts.dashboard')

@section('content')


@if (session('delete'))
<div class="alert alert-success">
    {{session('delete')}}
</div>  
@endif

@if (session('Update'))
<div class="alert alert-success">
    {{session('Update')}}
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
@if (session('create'))
<div class="alert alert-success">
    {{session('create')}}
</div>
@endif
<a class="addEvents"  href="{{route('evenements.create')}}"><i class="bi bi-plus-circle-fill"></i>  Add Evenements</a>
<div class="list">

  <form class="d-flex mb-3 w-50" role="search" action="{{route('evenements.search')}}" method="GET">
    <input class="form-control me-2 bg bg-dark text-light border border-dark outline-light" type="search" placeholder="Search" aria-label="Search" name="search-evenements" value="{{request()->q ?? ''}}">
    <button class="btn btn-outline-light" type="submit" >
      <i class="bi bi-search"></i>
    </button>
</form>
  {{-- {{$evenements->links()}} --}}

  @foreach ($evenements as $evenement)
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
          @if ($evenement->players_number == 0)
              <p class="bg bg-danger text-center nbr"> évènement victime de son succès</p>
              @else
              <p class="nbr">{{$evenement->players_number}}-place</p>
              @endif
          <h3 id="category">{{$evenement->category->name}}</h3>
          <p>
            {{$evenement->lieu}} - {{$evenement->adresse}}
          </p>
          <p>durée - {{$evenement->duree}} h</p>
        </div>
        <div class="show">
          <a href="{{route('evenements.show', ['evenement'=>$evenement->id]) }}"><i class="bi bi-zoom-in"></i></a>

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
    </div>

@endsection
