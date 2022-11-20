@extends('layouts.userspage')

@section('content')
<div class="container p-4">
    @if (session('participe'))
    <div class="alert alert-success">
        {{session('participe')}}
    </div>
@endif   
    <form action="{{route('userEvenements.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card bg bg-dark text-light">
            <div class="card-body">
                <h5 class="card-header">Crée votre évenement </h5>
                <br>
                <div class="card mb-3 bg bg-dark">
                    <div class="col-mb-4">
                        <input type="checkbox" name="play" class="btn-check " id="foot" value="play">
                        <label class="btn btn-outline-success" for="foot">je participe</label>
                    </div>
                    <br>
                    <label for="category">Catégories</label>
                    <select class="custom-select bg bg-dark text-light" name="categories" id="categories">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="card mb-3 bg bg-dark">
                    <label for="title">Titre</label>
                    <input class="bg bg-dark text-light" type="text" name="title" id="title" @error('title')is-invalid @enderror">
                    @error('title')
                    <div class="alert alert-danger">
                     {{$message}}
                    </div>
                 @enderror
                </div>

                <div class="card mb-3 bg bg-dark">
                    <label for="player">nombre de joueur</label>
                    <input type="number" name="player" id="player" class="bg bg-dark text-light" >
                </div>
                
                <div class="card mb-3 bg bg-dark ">
                    <label for="texte">description</label>
                    <textarea class="form-control bg bg-dark text-light" id="texte" name="description" rows="3" required></textarea>
                </div>

               
            </div>

            <h5 class="card-header">Votre localisation</h5>
            <div class="card-body">
                <div class="card mb-3 bg bg-dark">
                    <label for="region">Région</label>
                    <select class="custom-select bg bg-dark text-light" name="region" id="region">
                        @foreach ($regions as $region)
                        <option value="{{$region->name}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                </div>


        
                <div class="card mb-3 bg bg-dark">
                    <label for="ville">Ville</label>
                    <input class="bg bg-dark text-light" type="text" name="ville" id="ville">
                </div>

                <div class="card mb-3 bg bg-dark">
                    <label for="lieu">lieu de l'évenement</label>
                    <input type="text" class="bg bg-dark text-light" name="lieu" id="lieu" >
                </div>

                {{-- <div class="card mb-3"> --}}
                    <label for="adresse">adresse <i class="bi bi-geo-alt-fill"></i></label>
                    <input type="text" name="adresse" id="adresse" >
                {{-- </div> --}}

              
        
              
            </div>

            <h5 class="card-header">Date, Heure et durée de l'évenement</h5>
            <div class="card-body bg bg-dark"> 

                <div class="card mb-3 bg bg-dark">
                    <label for="date">date de l'évenement</label>
                    <input type="date" class="bg bg-dark text-light" name="date" id="date" min="{{now()}}" >
                </div>

                <div class="card mb-3 bg bg-dark">
                        <label for="heure">heure de l'évenement</label>
                        <input type="time" class="bg bg-dark text-light" name="heure" id="heure" >
                    </div>

                <div class="card mb-3 bg bg-dark">
                    <label for="duree">Durée de l'évenement</label>
                    <input type="time" name="duree" id="duree" class="bg bg-dark text-light" >
                </div>
            </div>
        </div>
       
        
        <button type="submit" class="btn btn-dark mt-2">Valider</button>   
    
    </form>

</div>
@endsection