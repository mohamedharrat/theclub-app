@extends('layouts.dashboard')

@section('content')
<div class="card bg bg-dark">
    <div class="card-body bg bg-dark text-light">
      <h5 class="card-title">Reponse a {{$aideAdmins->email}}</h5>
      <h6>--{{$aideAdmins->title}}--</h6>
      <p class="card-text">"{{$aideAdmins->content}}"</p>
      <form action="{{route('reponse.store')}}" method="post">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4 text-light">
          <input type="text" id="title" class="form-control" name="title"/>
          <label class="form-label" for="title">titre de la réponse</label>
        </div>
      
      
        <!-- Message input -->
        <div class="form-outline mb-4 text-light">
          <textarea class="form-control" id="message" rows="4" name="content"></textarea>
          <label class="form-label" for="message">Réponse</label>
        </div>


      <input type="text" value="{{$aideAdmins->id}}" name="aideAdmin_id" hidden>
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-success  mb-4">Envoyer</button>
      </form>
    </div>
  </div>
@endsection