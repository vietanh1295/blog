@extends('layouts.app')
@section('content')
<button class="btn btn-success" onclick="removeForm()" data-toggle="modal" data-target="#myModal">Add new post</button>
<h2>Posts written by
  @if(auth()->user()->role_id == 0)
  you
  @elseif(auth()->user()->role_id == 1)
  {{$user->name}}
  @endif
</h2>
<table id="example" class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Body</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if($articles && count($articles)>0)
    @foreach($articles as $article)
    <tr id="article{{$article->id}}">
      <td><a href="{{ url('/') }}/articles/{{$article->id}}">{{str_limit($article->title, 25)}}</a></td>
      <td>{{str_limit($article->body, 50)}}</td>
      <td>{{$article->created_at}}</td>
      <td>{{$article->updated_at}}</td>
      <td><button class="btn" onclick="updateForm({{$article}})" data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
        <button class="btn" onclick="deleteData({{$article->id}})"><span class="fas fa-trash"></span></button></td>
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
          {{ Form::open(array('url' => '', 'method' => '','id'=>'update')) }}
          {{Form::number('id', '', array('class'=>'d-none','id'=>'article_id'))}}
          {{Form::number('user_id', $user->id, array('class'=>'d-none','id'=>'user_id'))}}
          <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', array('class'=>'form-control','id'=>'title'))}}
          </div>
          <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', array('class'=>'form-control','id'=>'body'))}}
          </div>
          <button type="button" class="btn btn-success" id="submit" name="button">Submit</button>
          {{ Form::close() }}
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
        </div>

      </div>
      <script type="text/javascript" src="{{ asset('js/crudposts.js') }}"></script>
      @endsection
