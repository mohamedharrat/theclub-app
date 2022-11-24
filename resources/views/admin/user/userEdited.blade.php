@extends('layouts.dashboard')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container bg bg-dark">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg bg-dark text-light">
                <div class="card-header">UPDATE</div>

                <div class="card-body">
                    <form method="post" action="{{route('users.update',['user' => $user->id])}}">
                        @csrf
                        

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom et Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Adresse Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               <br>
                               <br>
                                <select name="role" id="role" class="form-select w-50">
                                    <option value="admin" class="form-control">Admin</option>
                                    <option value="user" class="form-control">User</option>
                                </select>
        
                                <br>
                                <br>
                                <div class="">
                                    <label for="region" class="">Région</label>
                                    <select class="custom-select  bg bg-dark text-light " name="region" id="region">
                                        @foreach ($regions as $region)
                                        <option value="{{$region->name}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="">
                                    <label for="ville" class="">ville</label>
                                    <input type="text" class="" name="ville" value="{{$user->city}}">
                                </div>
                            </div>
                        </div>

                       
                        
                       
                    </div>


                      

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection