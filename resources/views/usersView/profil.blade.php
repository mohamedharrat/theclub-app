@extends('layouts.userspage')

@section('content')
    <div class="profil-cont">
        <div class="profil-info">
            <div class="bande"></div>
            <h2>{{Auth::user()->name}}</h2>
            <p>{{Auth::user()->email}}</p>
            <p>Rôle : {{Auth::user()->role}}</p>
            <p>inscrit : {{Auth::user()->created_at->diffForHumans()}}</p>
        </div>
    </div>
@endsection