@extends('layouts.dashboard')

@section('content')
<table class="table align-middle mb-0 bg-dark text-light">
    <thead class="bg-dark text-light">
      <tr>
        <th>Email</th>
        <th>Title</th>
        <th>Status</th>
        <th>verified</th>
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
                <p class=" mb-0">{{$aideAdmin->email}}</p>
            </div>
        </div>
    </td>
    <td>
        <p class=" mb-0">{{$aideAdmin->title}}</p>
    </td>
    <td>
        <span class="">{{$aideAdmin->status}}</span>
    </td>
    <td>
        <span class="text-center">{{$aideAdmin->verified}}</span>
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