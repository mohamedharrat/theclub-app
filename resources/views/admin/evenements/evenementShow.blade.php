<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/user/evenementShow.css')}}" />
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="content">

        <x-navbar-layouts/>
        @if (session('ajouter'))
        <div class="alert alert-success">
            {{session('ajouter')}}
        </div>  
        @endif
        @if (session('annuler'))
        <div class="alert alert-danger">
            {{session('annuler')}}
        </div>  
        @endif
        <div class="info-ev">
            <header></header>
            <section>
                @if ($evenements->category->name == "tennis")
                <div class="cat" id="heure" style="background: orange">
                    <h2>{{$evenements->category->name}}</h2> 
                </div>
                @elseif($evenements->category->name == 'basket')
                <div class="cat" id="heure" style="background: rgb(4, 4, 118)">
                    <h2>{{$evenements->category->name}}</h2> 
                </div>
                @else
                <div class="cat" id="heure" style="background: rgb(14, 129, 51)">
                    <h2>{{$evenements->category->name}}</h2> 
                </div>
                @endif
                <div class="sec-2">
                    <h3>{{$evenements->lieu}}</h3>
                    <h4>{{$evenements->date}}</h4>
                    <div class="info">
                        <div class="p">
                            <i class="bi bi-clock"></i>
                            <p>{{$evenements->heure}}</p>
                        </div>
            <div class="p">
                <i class="bi bi-hourglass"></i>
                <p>{{$evenements->duree}}</p>
            </div>
            <div class="p">
                <i class="bi bi-people-fill"></i>
                <p>{{$evenements->players_number}}</p>
            </div>
        </div>
        <div class="reste">
            <p>Event : {{$evenements->title}}</p>
            <p>description : {{$evenements->description}}</p>
            <p>Adresse : {{$evenements->adresse}}</p>
        </div>
        <h5>Event crée par <br> {{$evenements->author->name}}</h5>
        <div class="list">
            <h6>Liste des participant</h6>
            <ul id="players">
                @foreach ($evenements->players as $player)
                <li>
                    {{$player->name}}
                    <form id="delete_player-{{$player->id}}" action="{{route('evenements.adminDeletePlayers',['id'=>$evenements->id])}}" method="post">
                        <input type="text" name="player" value="{{$player->id}}" hidden>
                        <input type="text" name="evenement" value="{{$evenements->id}}" hidden>
                        <button  class="bg bg-danger" onclick="if(confirm('Êtes-vous sûr de vouloir annuler la participation?')){document.getElementById('delete_players-{{$player->id}}').submit()}" style="text-decoration: none">
                            <i class="bi bi-trash px-1"></i>
                        </button>
                        @csrf
                        @method('delete')
                    </form>
                    
                </li>
                @endforeach
            </ul>
        </div>
        @if ($evenements->players_number == 0)
        
        <h3 class="bg bg-danger text-center p-2 mt-2">évènement complet</h3>
        
        @else
        
        <div class="submit">
            <form action="{{route('evenements.ajoutPlayer', ['id' => $evenements->id])}}" method="get">
                
                <label for="user" class="text-light">Choisir un utilisateur</label>
                <select name="user" id="user" class="mt-2" >
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">AJOUTER</button>
                
            </form>
        </div>
        @endif
    </div>
</section>
</div>
<script src="{{asset('js/show.js')}}"></script>

</div>
</body>
</html>