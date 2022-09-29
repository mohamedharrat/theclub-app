<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>THE CLUB</title>
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

    <link rel="stylesheet" href="{{asset('css/accueil.css')}}" />
    <link rel="stylesheet" href="{{asset('css/navbar-accueil.css')}}" />
  </head>
  <body>
    <div class="cont">
      <div class="titre">
        <h1>THE CLUB</h1>
        <p>Faire du sport est devenu facile ...</p>
      </div>
      <div class="register">
        <h2 class="insc">INSCRIPTION</h2>
        <i class="bi bi-caret-down-fill"></i>
        <x-navbar/>
      </div>
      <div class="photo">
        <div
          id="carouselExampleSlidesOnly"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="{{asset('photo-accueil/tennis.jpg')}}"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="{{asset('photo-accueil/foot.jpg')}}"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="{{asset('photo-accueil/basket.jpg')}}"
                class="d-block w-100"
                alt="..."
              />
            </div>
          </div>
        </div>
      </div>
      <footer>
        <h4>NOUS CONTACTER</h4>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium,
          fuga.
        </p>
        <div class="logo">
          <ul>
            <li>
              <a href="#"><i class="bi bi-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="bi bi-facebook"></i></a>
            </li>
            <li>
              <a href="#"><i class="bi bi-instagram"></i></a>
            </li>
            <li>
              <a href="#"><i class="bi bi-youtube"></i></a>
            </li>
          </ul>
        </div>
      </footer>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
