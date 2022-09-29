<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/auth/verify.css')}}" />

</head>
<body>
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
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
      <link rel="stylesheet" href="{{asset('css/auth/verify.css')}}" />
    
    </head>
    <body>
        <div class="nav">
                    <x-navbar/>
        </div>
        <div class="verify">
            <div class="card">
                <h2>verify email address</h2>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn">
                            {{ __('Resend email') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
            
        </div>
                    
        <div class="photo-reg"></div>
                      
                    
    </body>
    </html>
    

