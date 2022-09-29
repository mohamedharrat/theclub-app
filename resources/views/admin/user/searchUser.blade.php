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

    
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>email</th>
                <th>role</th>
                <th>creation date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @if ($results->count() == 0)
                <div class="alert alert-danger">
                    <h3>Aucun résultat  trouvé!</h3>
                </div>
            @else
            <div class="alert alert-success">
                <h3> {{$results->count()}} résultat(s)  trouvé(s)!</h3>
            </div>
            @foreach ($results as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="{{route('users.edit',['user'=>$user->id])}}" style="text-decoration: none">
                        <i class="bi bi-pencil-square px-1"></i>
                    </a>
                    <a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')){document.getElementById('delete-{{$user->id}}').submit()}" style="text-decoration: none">
                        <i class="bi bi-trash px-1"></i>
                    </a>
                    {{-- <a href="{{route('users.view',['id'=>$user->id])}}" style="text-decoration: none">
                        <i class="bi bi-eye"></i>
                    </a> --}}

                    <form id="delete-{{$user->id}}" action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>

            </tr>
            @endforeach
            @endif            
        </tbody>
    </table>
    {{$results->links()}}
@endsection