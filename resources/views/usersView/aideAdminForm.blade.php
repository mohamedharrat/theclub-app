@extends('layouts.userspage')

@section('content')
<div class="cont-aide">
  <h4 class="text-light m-4">Demande d'aide à un administrateur/ <a class="btn btn-success" href="{{route('reponse.index')}}">Réponses des administrateurs</a> </h4>
  <div class="aide-amin">
    <form action="{{route('aideAdmin.store')}}" method="post">
      @csrf
      <!-- Name input -->
      <div class="form-outline mb-4 text-light">
        <input type="text" id="title" class="form-control" name="title"/>
        <label class="form-label" for="title">titre</label>
      </div>
      
      
      <!-- Message input -->
      <div class="form-outline mb-4 text-light">
        <textarea class="form-control" id="message" rows="4" name="content"></textarea>
        <label class="form-label" for="message">Message</label>
      </div>
      
      
      <!-- Submit button -->
      <button type="submit" class="btn btn-success  mb-4">Envoyer</button>
    </form>
  </div>

  @endsection