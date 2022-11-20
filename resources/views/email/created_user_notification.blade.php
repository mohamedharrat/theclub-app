<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Created</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    {{-- <h2>Email de notification de compte créer</h2>
    <p>Un compte à été créé par THE CLUB</p>
    <p>
        <strong>Nom:</strong> {{$user['name']}}
        <strong>Email:</strong> {{$user['email']}}
        <strong>password:</strong> {{$user['pass']}}
    </p> --}}
    <div class="card text-center">
        <div class="card-header">THE CLUB</div>
        <div class="card-body">
          <h5 class="card-title">Creation de votre compte</h5>
          <p class="card-text">{{$user['name']}}</p>
          <p class="card-text">{{$user['email']}}</p>
          <p class="card-text"> mot de passe : {{$user['pass']}}</p>
        </div>
        <div class="card-footer text-muted">pour modifier votre mot de passe utilisé "mot de passe oublier"</div>
      </div>
</body>
</html>