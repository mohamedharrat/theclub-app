@extends('layouts.dashboard')

@section('content')
<a class="addUser" style="color:black" href="{{route('users.create')}}"><i class="bi bi-person-plus-fill"></i>  Add User</a>
 <br>
@if (session('delete'))
<div class="alert alert-success">
    {{session('delete')}}
</div>  
@endif

@if (session('compteUpdate'))
<div class="alert alert-success">
    {{session('compteUpdate')}}
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
<form class="d-flex mb-3 w-50" role="search" action="{{route('users.search')}}" method="GET">
    <input class="form-control me-2 bg bg-dark text-light border border-dark outline-light" type="search" placeholder="Search" aria-label="Search" name="search-user" value="{{request()->q ?? ''}}">
    <button class="btn btn-outline-light" type="submit" >
      <i class="bi bi-search"></i>
    </button>
</form>
{{-- <table class="table table-bordered border-dark text-center" > --}}
    {{-- {{$users->links()}} --}}
{{-- 

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
        @foreach ($users as $user)
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
                   

                    <form id="delete-{{$user->id}}" action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table> --}}

    {{-- {{$users->links()}} --}}

    @foreach ($users as $user)
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
    @endforeach

@endsection