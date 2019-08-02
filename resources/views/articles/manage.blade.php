@extends('layouts.app')
@section('content')
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
      <td><a href="http://localhost/articles/{{$article->id}}">{{str_limit($article->title, 25)}}</a></td>
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
          {{ Form::open(array('url' => 'articles', 'method' => 'PUT','id'=>'update')) }}
          {{Form::number('id', '', array('class'=>'d-none','id'=>'article_id'))}}
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
          <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
        </div>

      </div>
<script>

  // $('#example').DataTable();
  function updateForm(data){
    $("#article_id").val(data.id);
    $("#title").val(data.title);
    $("#body").val(data.body);
  }
  function deleteData(id){
    console.log(id)
  }
  $('#update').submit(function(e){
    e.preventDefault();
    id = $('#article_id').val();
    axios.put(`/articles/${id}`, {
      title: $('#title').val(),
      body: $('#body').val()
    })
    .then(function (data) {
      $('#message').html(
        `<div class="alert alert-success">
        ${data.statusText}
        </div>`)
      $('.alert').fadeOut(3000)
      // console.log(data.data.id)
      if(data.data.body.length>50){
        body=data.data.body.substr(0,50)+"...";
      }
      else{
        body=data.data.body;
      }
      if(data.data.title.length>25){
        title=data.data.title.substr(0,25)+"...";
      }
      else{
        title=data.data.title;
      }
      var jsondata = JSON.stringify(data.data);
      $(`#article${data.data.id}`).html(`
          <td><a href="http://localhost/articles/${data.data.id}">${title}</a></td>
          <td>${body}</td>
          <td>${data.data.created_at}</td>
          <td>${data.data.updated_at}</td>
          <td><button class="btn" onclick='updateForm(${jsondata})' data-toggle="modal" data-target="#myModal"><span class="fas fa-edit"></span></button>
          <button class="btn" onclick="deleteData(${data.data.id})"><span class="fas fa-trash"></span></button></td>
        `)
      $(`#article${data.data.id}`).addClass('highlight');
      $('#close').click();
      setTimeout(function(){$(`#article${data.data.id}`).removeClass('highlight')}, 2500);
    })
    .catch(function (error) {
      console.log(error.response.data.errors);
      var errors = Object.keys(error.response.data.errors) ;
      var error_name = errors[0];
      // console.log(error_name)
      $('#message').html(
        `<div class="alert alert-danger">
        ${error.response.data.errors[error_name]}
        </div>`)
        $('.alert').fadeOut(3000)
    });
  })
</script>
@endsection
