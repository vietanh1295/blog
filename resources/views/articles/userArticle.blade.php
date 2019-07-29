@extends('layouts.app')
@section('content')
<div class="card" style="width:400px">
    <h4 class="card-title">
      Author Information
    </h4>
    <img class="card-img-top" src="{{ asset('profile_img/profile.png') }}" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title" style="text-align:center;">{{$user->name}}</h4>
      <h5 class="card-text">Email: {{$user->email}}</h5>
      <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
    </div>
  </div>
  <br>
<h1>Articles by this author</h1>
@if($articles && count($articles)>0)
<div class="row">
@foreach($articles as $article)
<div class="card col-md-4 col-sm-6">
    <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%"> -->
    <div class="card-body">
      <h4 class="card-title">{{$article->title}}</h4>
      <p class="card-text"> {{str_limit($article->body, 100)}} <a href="http://localhost/articles/{{$article->id}}">See more</a></p>
    </div>
</div>
@endforeach
</div>
@else
  <h2>there are no articles</h2>
@endif
@endsection
