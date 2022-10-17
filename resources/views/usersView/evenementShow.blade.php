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

        <ul>
            @foreach ($userEvenements->players as $player)
                <li>
                    {{$player->name}}
                </li>
            @endforeach
        </ul>
        <a href="{{route('userEvenements.participe', ['id' => $userEvenements->id])}}">PARTICIPER</a>
    </div>
</section>
</div>

</body>
</html>
  