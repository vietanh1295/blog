
@extends('layouts.app')
@section('content')
<h1>{{$article->title}}</h1>
<h5>Written by: <a href="http://localhost/user/{{$user->id}}">{{$user->name}}</a></h5>
<p>{!!$article->body!!}</p>
@endsection
