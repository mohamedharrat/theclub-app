<a href="{{route('evenements.edit',['evenement'=>$evenement->id])}}" style="text-decoration: none">
    <i class="bi bi-pencil-square px-1"></i>
</a>
<a href="#" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet événement?')){document.getElementById('delete-{{$evenement->id}}').submit()}" style="text-decoration: none">
    <i class="bi bi-trash px-1"></i>
</a>  
<form id="delete-{{$evenement->id}}" action="{{route('evenements.destroy',['id'=>$evenement->id])}}" method="post">
    @csrf
    @method('delete')
</form>