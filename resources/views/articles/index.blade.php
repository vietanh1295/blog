@extends('layouts.app')
@section('content')
@if(count($articles)>0)
<div class="row">
@foreach($articles as $article)
<div class="card col-md-4 col-sm-6">
    <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%"> -->
    <div class="card-body">
      <h4 class="card-title">{{$article->title}}</h4>
      <p class="card-text"> {{str_limit($article->body, 100)}} <a href="articles/{{$article->id}}">See more</a></p>
      <h5>Author:</h5><a href="user/{{$article->user_id}}">{{$article->author}}</a>
    </div>
</div>
@endforeach
</div>
{{ $articles->links() }}
@else
  <h2>there are no articles</h2>
@endif
@endsection
