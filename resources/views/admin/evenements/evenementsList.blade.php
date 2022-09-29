@extends('layouts.dashboard')

@section('content')
<a class="addEvents" style="color:black;margin-bottom:20px" href="{{route('evenements.create')}}"><i class="bi bi-plus-circle-fill"></i>  Add Evenements</a>
<br>

@if (session('delete'))
<div class="alert alert-success">
    {{session('delete')}}
</div>  
@endif

@if (session('Update'))
<div class="alert alert-success">
    {{session('Update')}}
</div>
@endif
@if (session('inscription'))
<div class="alert alert-success">
    {{session('inscription')}}
</div>
@endif

@if (session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-success">
    {{session('error')}}
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
{{-- <form class="d-flex mb-3 w-50" role="search" action="{{route('users.search')}}" method="GET">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-user" value="{{request()->q ?? ''}}">
    <button class="btn btn-outline-dark" type="submit" >
      <i class="bi bi-search"></i>
    </button>
</form> --}}
<table class="table table-bordered  text-center" >
    {{-- {{$users->links()}} --}}


    <thead>
        <tr>
            <th>#</th>
            <th>title</th>
            <th>description</th>
            <th>date-heure</th>
            <th>durée</th>
            <th>region</th>
            <th>ville</th>
            <th>adresse</th>
            <th>categorie</th>
            <th>author</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evenements as $evenement)
            <tr>
                <td>{{$evenement->id}}</td>
                <td>{{$evenement->title}}</td>
                <td>{{$evenement->description}}</td>
                <td>{{$evenement->date_heure}}</td>
                <td>{{$evenement->duree}}</td>
                <td>{{$evenement->region}}</td>
                <td>{{$evenement->city}}</td>
                <td>{{$evenement->adresse}}</td>
                <td>{{$evenement->category->name}}</td>
                <td>{{$evenement->author->name}}</td>
                 <td>
                    
                    <a href="{{route('evenements.edit',['evenement'=>$evenement->id])}}" style="text-decoration: none">
                        <i class="bi bi-pencil-square px-1"></i>
                    </a>
                    <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet événement?')){document.getElementById('delete-{{$evenement->id}}').submit()}" style="text-decoration: none">
                        <i class="bi bi-trash px-1"></i>
                    </a> 
                    {{-- <a href="{{route('users.view',['id'=>$user->id])}}" style="text-decoration: none">
                        <i class="bi bi-eye"></i>
                    </a> --}}

                    <form id="delete-{{$evenement->id}}" action="{{route('evenements.destroy',['id'=>$evenement->id])}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

    {{-- {{$users->links()}} --}}


@endsection
