@extends('layouts.app')
@section('content')
<div id="message" style="width:100%; height:50px;">

</div>
{{ Form::open(array('url' => 'articles', 'method' => 'POST','id'=>'create')) }}
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
<script>
$("#create").submit(function(e){
  e.preventDefault();
  axios.post('{{ url('/') }}/articles', {
    title: $('#title').val(),
    body: $('#body').val()
  })
  .then(function (response) {
    $('#message').html(
      `<div class="alert alert-success">
      ${response.statusText}
      </div>`)
    $('.alert').fadeOut(3000)
  })
  .catch(function (error) {
    // console.log(error.response.data.errors);
    var errors = Object.keys(error.response.data.errors) ;
    var error_name = errors[0];
    console.log(error_name)
    $('#message').html(
      `<div class="alert alert-danger">
      ${error.response.data.errors[error_name]}
      </div>`)
      $('.alert').fadeOut(3000)
  });
})
</script>
@endsection
