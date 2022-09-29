<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/auth/forgot-password.css')}}" />

</head>
<body>
    @if (session('status'))
        <div class="notif">
            {{session('status')}}
        </div>
    @endif
<div class="forgot">
    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <h2>Mot de passe oublié</h2>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                                <button type="submit" class="btn btn-primary">
                                    {{ __('reset password') }}
                                </button>

                               
                          
                    </form>
</div>
                    
             

</body>
</html>
