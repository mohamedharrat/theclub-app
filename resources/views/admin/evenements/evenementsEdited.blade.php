@extends('layouts.dashboard')
@section('content')
<div class="row">

</div>
    <div class="container p-4">
                    
        <form action="{{route('evenements.update',['evenement'=>$evenement->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card bg bg-dark">
                <div class="card-body">
                    <h5 class="card-header">Modifié votre évenement </h5>
                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="category">Catégories</label>
                        <select class="custom-select bg bg-dark text-light" name="categories" id="categories">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="title">Titre</label>
                        <input class="bg bg-dark text-light" type="text" name="title" id="title" value="{{$evenement->title}}">
                    </div>

                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="player">nombre de joueur</label>
                        <input type="number" name="player" id="player" class="bg bg-dark text-light" min="1" value="{{$evenement->players_number}}">
                    </div>
                    
                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="texte">description</label>
                        <textarea class="form-control bg bg-dark text-light" id="texte" name="description" rows="3" required{{$evenement->description}}></textarea>
                    </div>

                   
                </div>

                <h5 class="card-header text-light">Votre localisation</h5>
                <div class="card-body">
                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="region">Région</label>
                        <select class="custom-select bg bg-dark text-light" name="region" id="region">
                            @foreach ($regions as $region)
                            <option value="{{$region->name}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>

    
            
                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="city">ville</label>
                        <input class="bg bg-dark text-light  @error('city')is-invalid @enderror" type="text" name="city" id="city" value="{{$evenement->city}}">
                    </div>

                    {{-- <div class="card mb-3"> --}}
                        <label class="text-light" for="adresse">adresse <i class="bi bi-geo-alt-fill text-light"></i></label>
                        <input type="text" name="adresse" id="adresse" value="{{$evenement->adresse}}">
                    {{-- </div> --}}

                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="lieu">lieu de l'évenement</label>
                        <input type="text" class="bg bg-dark text-light" name="lieu" id="lieu" value="{{$evenement->lieu}}">
                    </div>

                  
            
                  
                </div>

                <h5 class="card-header bg bg-dark text-light">Heure et durée de l'évenement</h5>
                <div class="card-body"> 

                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="date">date de l'évenement</label>
                        <input type="date" class="bg bg-dark text-light" name="date" id="date" value="{{$evenement->date}}">
                    </div>

                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="heure">heure de l'évenement</label>
                        <input type="time" class="bg bg-dark text-light" name="heure" id="heure" value="{{$evenement->heure}}">
                    </div>

                    <div class="card mb-3 bg bg-dark text-light">
                        <label for="duree">Durée de l'évenement</label>
                        <input class="bg bg-dark text-light" type="time" name="duree" id="duree" value="{{$evenement->duree}}">
                    </div>
                </div>
            </div>
           
            
            <button type="submit" class="btn btn-dark mt-3">Valider</button>   
        
        </form>

    </div>
@endsection

    