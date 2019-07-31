@extends('layouts.app')
@section('content')
<table id="example" class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Body</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if($articles && count($articles)>0)
    @foreach($articles as $article)
    <tr>
      <td><a href="http://localhost/articles/{{$article->id}}">{{str_limit($article->title, 25)}}</a></td>
      <td>{{str_limit($article->body, 50)}}</td>
      <td><button class="btn" onclick="updateForm({{$article}})" data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
      <button class="btn"><span class="fas fa-trash"></span></button></td>
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
          {{ Form::open(array('url' => 'articles', 'method' => 'PUT','id'=>'create')) }}
          <div class="form-group">
          {{Form::label('title', 'Title')}}
          {{Form::text('title', '', array('class'=>'form-control','id'=>'title'))}}
          </div>
          <div class="form-group">
          {{Form::label('body', 'Body')}}
          {{Form::textarea('body', '', array('class'=>'form-control','id'=>'body'))}}
          </div>
          {{Form::submit('Submit',array('class'=>'btn btn-success'))}}
          {{ Form::close() }}
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
<script>

  $('#example').DataTable();
  function updateForm(data){
    $("#title").val(data.title);
    $("#body").val(data.body);
  }
</script>
@endsection
