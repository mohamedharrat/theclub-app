@extends('layouts.dashboard')
@section('title','liste d\'articles')
@section('content')
    {{$results->links()}}

    @if (session('delete'))
        <div class="alert alert-success">
            {{session('delete')}}
        </div>  
    @endif

    @if (session('update'))
        <div class="alert alert-success">
            {{session('update')}}
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

    
   
            @if ($results->count() == 0)
                <div class="alert alert-danger">
                    <h3>Aucun résultat  trouvé!</h3>
                </div>
            @else
            <div class="alert alert-success">
                <h3> {{$results->count()}} résultat(s)  trouvé(s)!</h3>
            </div>
            @foreach ($results as $user)
            <div class="card bg bg-dark text-light mb-5">
                <div class="card-header">{{$user->id}}.  {{$user->name}}</div>
                <div class="card-body">
                  <h5 class="card-title">{{$user->email}}</h5>
                  <p class="card-text">Rôle : {{$user->role}} / inscrit depuis :  {{$user->created_at}}</p>
                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    <a href="{{route('users.edit',['user'=>$user->id])}}" style="text-decoration: none">
                        <i class="bi bi-pencil-square px-1"></i> Modifier
                    </a>
                    <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')){document.getElementById('delete-{{$user->id}}').submit()}" style="text-decoration: none">
                        <i class="bi bi-trash px-1"></i> Supprimer
                    </a>
                   
        
                    <form id="delete-{{$user->id}}" action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
              </div>
            </tr>
            @endforeach
            @endif            
       
    {{$results->links()}}
@endsection