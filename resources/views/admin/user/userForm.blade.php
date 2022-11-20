@extends('layouts.dashboard')

@section('content')

@if (session('erroRegister'))
    <div class="alert alert-danger">
        {{session('errorRegister')}}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg bg-dark text-light">
                <div class="card-header">INSCRIPTION</div>

                <div class="card-body">
                    <form method="POST" action="{{route('users.store')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom et Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Adresse Email') }}</label>
                            <br>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <input type="text" class="" name="ville">
                                </div>
                                
                               
                            </div>
                        </div>


                            
                            

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('inscrire') }}
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