<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/user/evenementShow.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
      <x-navbar-layouts/>
<div class="info-ev">
    <header></header>
    <section>
        @if ($userEvenements->category->name == "tennis")
        <div class="cat" id="heure" style="background: orange">
            <h2>{{$userEvenements->category->name}}</h2> 
        </div>
        @elseif($userEvenements->category->name == 'basket')
        <div class="cat" id="heure" style="background: rgb(4, 4, 118)">
            <h2>{{$userEvenements->category->name}}</h2> 
        </div>
    @else
    <div class="cat" id="heure" style="background: rgb(14, 129, 51)">
        <h2>{{$userEvenements->category->name}}</h2> 
    </div>
    @endif
    <div class="sec-2">
        <h3>{{$userEvenements->lieu}}</h3>
        <h4>{{$userEvenements->date}}</h4>
        <div class="info">
            <div class="p">
                <i class="bi bi-clock"></i>
                <p>{{$userEvenements->heure}}</p>
            </div>
            <div class="p">
                <i class="bi bi-hourglass"></i>
                <p>{{$userEvenements->duree}}</p>
            </div>
            <div class="p">
                <i class="bi bi-people-fill"></i>
                <p>{{$userEvenements->players_number}}</p>
            </div>
        </div>
        <div class="reste">
            <p>Event : {{$userEvenements->title}}</p>
            <p>description : {{$userEvenements->description}}</p>
            <p>Adresse : {{$userEvenements->adresse}}</p>
        </div>
        <h5>Event crée par <br> {{$userEvenements->author->name}}</h5>
        <div class="list">
            <h6>Liste des participant</h6>
            <ul id="players">
                @foreach ($userEvenements->players as $player)
                    <li>
                        {{$player->name}}
                        <form id="delete_player-{{$player->id}}" action="{{route('userEvenements.deletePlayers',['id'=>$userEvenements->id])}}" method="post">
                            <input type="text" name="player" value="{{$player->id}}" hidden>
                            <input type="text" name="evenement" value="{{$userEvenements->id}}" hidden>
                            @if ($userEvenements->author_id == Auth::user()->id)
                            <button  class="bg bg-danger" onclick="if(confirm('Êtes-vous sûr de vouloir annuler la participation?')){document.getElementById('delete_players-{{$player->id}}').submit()}" style="text-decoration: none">
                                <i class="bi bi-trash px-1"></i>
                            </button>
                            @csrf
                           @method('delete')
                        </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
        </div>
            <div class="submit">

                <p id="user" hidden>{{Auth::user()->name}}</p>
                {{-- @if ($player->id == Auth::user()->id) --}}
                <a id="participe" class="bg bg-success" href="{{route('userEvenements.participe', ['id' => $userEvenements->id])}}">PARTICIPER</a>
                {{-- @else --}}
                <a id="annuler" class="bg bg-danger " href="#" onclick="if(confirm('Êtes-vous sûr de vouloir annuler la participation?')){document.getElementById('delete_players-{{$userEvenements->id}}').submit()}" style="text-decoration: none">
                    ANNULER
                </a>  
                <form id="delete_players-{{$userEvenements->id}}" action="{{route('userEvenements.annuler',['id'=>$userEvenements->id])}}" method="post">
                    @csrf
                    @method('delete')
                </form>            {{-- @endif --}}
            </div>
    </div>
</section>
</div>
<script src="{{asset('js/show.js')}}"></script>

</body>
</html>
  