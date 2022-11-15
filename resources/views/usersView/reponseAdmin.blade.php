@extends('layouts.userspage')

@section('content')
<div class="rep">
    
    @foreach ($aideAdmins as $aideAdmin)
    <div class="card-body bg bg-dark text-light">
        <h5 class="card-title">{{$aideAdmin->title}}</h5>
        <p class="card-text">"{{$aideAdmin->content}}"</p>
        @foreach ($reponses as $reponse)
        <p class="card-text">"{{$reponse->title}}"</p>
        <p class="card-text">"{{$reponse->content}}"</p>
        @endforeach
    </div>
    @endforeach
    
</div>
@endsection