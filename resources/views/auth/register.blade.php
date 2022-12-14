<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
    crossorigin="anonymous"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
  />
  {{-- <link rel="stylesheet" href="{{asset('css/navbar-accueil.css')}}" /> --}}
  <link rel="stylesheet" href="{{asset('css/auth/register.css')}}" />

</head>
<body>
    
        <a class="accueil" href="/">Accueil</a>
    
<div class="registre">
    <h2>REGISTER</h2>
    {{-- @if ($errors->any())
    @foreach ($errors->all() as $error) 
    <div class="text-danger"> {{$error }} </div>
    @endforeach
    @endif --}}
  <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="text-light @error('name') is-invalid @enderror" name="name"   autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="text-light @error('email') is-invalid @enderror" name="email"   autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="text-light @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end ">{{ __('Confirm Password') }}</label>

                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="text-light @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="region" class="col-md-4 col-form-label text-md-end">R??gion</label>
                            <div class="col-md-4">
                                <select class="custom-select  bg bg-dark text-light " name="region" id="region">
                                    @foreach ($regions as $region)
                                    <option value="{{$region->name}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end ">ville</label>
                            <div class="col-md-4">
                                <input type="text" class="text-light @error('city') is-invalid @enderror" name="city" id="city" autocomplete="name">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>


                        <input type="text" value="user" name="role" hidden>

        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                
                <div class="photo-reg"></div>
                  
                
</body>
</html>
