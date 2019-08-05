@extends('layouts.app')

@section('content')
<table  class="table">
<thead>
  <tr>
    <th>name</th>
    <th>email</th>
    <th>role</th>
    <th>Created At</th>
    <th>Updated At</th>
  </tr>
</thead>
<tbody>
  @if($users)
  @foreach($users as $user)
  <tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>
      @if($user->role_id == 0)
      user
      @elseif($user->role_id == 1)
      admin
      @endif
    </td>
    <td>{{$user->created_at}}</td>
    <td>{{$user->updated_at}}</td>
  </tr>
  @endforeach
  @endif
</tbody>
</table>
@endsection
