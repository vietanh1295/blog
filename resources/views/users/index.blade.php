@extends('layouts.app')
@section('content')
<button class="btn btn-success" onclick="removeForm()" data-toggle="modal" data-target="#myModal">Add new user</button>
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
    <tr id="user{{$user->id}}">
      <td><a href="{{ url('/') }}/users/{{$user->id}}">{{$user->name}}</a></td>
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
      <td><button class="btn" onclick="updateForm({{$user}})" data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData({{$user->id}})"><span class="fas fa-trash"></span></button>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="message" style="width:100%; height:50px;">

        </div>
        <input type="number" class="d-none" class="form-control" id="user_id">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" name="email"  class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="role">Role:</label>
          <select class="form-control" id="role" name="role">
            <option value="0">User</option>
            <option value="1">Admin</option>
          </select>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd"  class="form-control" id="password">
          </div>
          <button type="button" class="btn btn-success" id="submit" name="button">Submit</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
        </div>

      </div>
      <script type="text/javascript" src="{{ asset('js/crudusers.js') }}"></script>
      @endsection
