@extends('layouts.app')
@section('content')
{{ Form::open(array('url' => 'articles', 'method' => 'POST')) }}
<div class="form-group">
{{Form::label('title', 'Title')}}
{{Form::text('title', '', array('class'=>'form-control'))}}
</div>
<div class="form-group">
{{Form::label('body', 'Body')}}
{{Form::textarea('body', '', array('class'=>'form-control'))}}
</div>
{{Form::submit('Submit',array('class'=>'btn btn-success'))}}
{{ Form::close() }}
@endsection
