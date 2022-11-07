@extends('layouts.userspage')

@section('content')
<div class="rep">
    @if ($reponses->count() == 0)
    <p>Il n'y a pas de réponse</p>
    @else
    @foreach ($reponses as $reponse)
    <div class="card-body bg bg-dark text-light">
        <h5 class="card-title">Réponse a </h5>
        <h6>--{{$reponse->title}}--</h6>
        <p class="card-text">"{{$reponse->content}}"</p>
    </div>
    @endforeach
    @endif
</div>
@endsection