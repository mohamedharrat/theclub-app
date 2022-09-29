@extends('layouts.dashboard')
@section('content')
<div class="row">

</div>
    <div class="container p-4">
                    
        <form action="{{route('evenements.update',['evenement'=>$evenement->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-header">Modifié votre évenement </h5>
                    <div class="card mb-3">
                        <label for="category">Catégories</label>
                        <select class="custom-select" name="categories" id="categories">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="card mb-3">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="{{$evenement->title}}">
                    </div>
                    
                    <div class="card mb-3">
                        <label for="texte">description</label>
                        <textarea class="form-control" id="texte" name="description" rows="3" required{{$evenement->description}}></textarea>
                    </div>

                   
                </div>

                <h5 class="card-header">Votre localisation</h5>
                <div class="card-body">
                    <div class="card mb-3">
                        <label for="region">Région</label>
                        <select class="custom-select" name="region" id="region">
                            @foreach ($regions as $region)
                            <option value="{{$region->name}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>

    
            
                    <div class="card mb-3">
                        <label for="municipality">ville</label>
                        <select class="custom-select" name="ville" id="ville">
                            @foreach ($villes as $ville)
                            <option value="{{$ville->name}}">{{$ville->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="card mb-3"> --}}
                        <label for="adresse">adresse <i class="bi bi-geo-alt-fill"></i></label>
                        <input type="text" name="adresse" id="adresse" value="{{$evenement->adresse}}">
                    {{-- </div> --}}

                  
            
                  
                </div>

                <h5 class="card-header">Heure et durée de l'évenement</h5>
                <div class="card-body"> 

                    <div class="card mb-3">
                        <label for="date_heure">date et heure de l'évenement</label>
                        <input type="datetime-local" name="date_heure" id="date_heure" value="{{$evenement->date_heure}}">
                    </div>

                    <div class="card mb-3">
                        <label for="duree">Durée de l'évenement</label>
                        <input type="time" name="duree" id="duree" value="{{$evenement->duree}}">
                    </div>
                </div>
            </div>
           
            
            <button type="submit" class="btn btn-primary">Valider</button>   
        
        </form>

    </div>
@endsection

    