@extends('layouts.userspage')

@section('content')
@if (session('compteUpdate'))
<div class="alert alert-success">
    {{session('compteUpdate')}}
</div>
@endif
  
            <div class="profil-info">
                <div class="info-p">

                    <h2>{{Auth::user()->name}}</h2>
                    <p>{{Auth::user()->email}}</p>
                    <p>{{Auth::user()->region}}</p>
                    <p>{{Auth::user()->city}}</p>
                    <p>Rôle : {{Auth::user()->role}}</p>
                    <p>inscrit : {{Auth::user()->created_at->diffForHumans()}}</p>
                    <a href="{{route('editProfil',['user', Auth::user()->id])}}">Modifier mon profile</a>
                </div>
            </div> 
      
    
@endsection