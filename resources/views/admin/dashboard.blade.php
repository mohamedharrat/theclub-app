@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-around ">

    <div class="card text-center bg bg-dark text-light ">
        <div class="card-header">Nombre d'utilisateur</div>
        <div class="card-body">
            <h5 class="card-title">{{$users->count()}}</h5>
            <p class="card-text"></p>
        </div>
    </div>

    <div class="card text-center bg bg-dark text-light  ml-4">
        <div class="card-header">Nombre d'évènement</div>
        <div class="card-body">
          <h5 class="card-title">{{$evenements->count()}}</h5>
          <p class="card-text"></p>
        </div>
      </div>
</div>
@endsection