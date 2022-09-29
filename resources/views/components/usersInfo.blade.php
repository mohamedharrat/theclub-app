<div class="container" id="users-info">

    <img src="" alt="">

    <h2>{{Auth::user()->name}}</h2>

    <p>Inscrit depuis : {{Auth::user()->created_at->diffForHumans()}}</p>

    <a href="#"><i class="bi bi-dribbble"></i></i> Mes evenements</a>

    <a href="#"><i class="bi bi-heart-fill"></i> mes favories</a>

    <a href="#"><i class="bi bi-chat-left-text-fill"></i> Discution</a>

</div>