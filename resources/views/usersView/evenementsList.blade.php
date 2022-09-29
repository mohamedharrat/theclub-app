@extends('layouts.userspage')

@section('content')
    @foreach ($evenements as $evenement)
    <div class="card mb-3" >
        <div class="row g-0">
          <div class="col-md-4 bg bg-success">
            <h2>{{$evenement->category->name}}</h2>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$evenement->city}} , {{$evenement->date_heure}}</h5>
              <p class="card-text">
                This is a wider card with supporting text below as a natural lead-in to
                additional content. This content is a little bit longer.
              </p>
              <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
              </p>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection