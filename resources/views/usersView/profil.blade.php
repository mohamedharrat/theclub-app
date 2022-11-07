@extends('layouts.userspage')

@section('content')

    <div class="profil-cont">
        <div class="profil-info">
            <div class="bande"></div>
            <h2>{{Auth::user()->name}}</h2>
            <p>{{Auth::user()->email}}</p>
            <p>Rôle : {{Auth::user()->role}}</p>
            <p>inscrit : {{Auth::user()->created_at->diffForHumans()}}</p>
            <a href="{{route('editProfil',['user', Auth::user()->id])}}">Modifier mon profile</a>
            @if (session('compteUpdate'))
<div class="alert alert-success">
    {{session('compteUpdate')}}
</div>
@endif
        </div> 
    </div>
    
@endsection