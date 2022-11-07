@extends('layouts.dashboard')

@section('content')
<h2>Liste des demandes des utilisateurs</h2>
<table class="table align-middle mb-0 bg-dark text-light">
    <thead class="bg-dark text-light">
      <tr>
        <th>Email</th>
        <th>Title</th>
        <th>Status</th>
        <th>Message</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($aideAdmins as $aideAdmin)
            
        <tr>
            <td>
                <div class="d-flex align-items-center">
            <div class="ms-3">
                <p class="text-muted mb-0">{{$aideAdmin->email}}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="text-muted mb-0">{{$aideAdmin->title}}</p>
    </td>
    <td>
        <span class="badge badge-success rounded-pill d-inline">{{$aideAdmin->status}}</span>
    </td>
    <td>{{Str::limit($aideAdmin->content, '20')}}</td>
    <td>
        <a href="{{route('aideAdmin.show', ['aideAdmin'=>$aideAdmin->id]) }}"><i class="bi bi-zoom-in"></i></a>
    </td>
</tr>
</tbody>
@endforeach
</table>
@endsection