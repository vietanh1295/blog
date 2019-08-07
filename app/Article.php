<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  public function index(){
    $articles = Article::paginate(10);
    for($i = 0; $i<count($articles); $i++){
      $user_id = $articles[$i]->user_id;
      $user = User::find($user_id);
      $name = $user->name;
      $articles[$i]->author = $name;
    }
    return $articles;
  }
  public function userArticle($id){
    $user = User::find($id);
    $articles = $user->articles;
    $data = [
      'articles'=>$articles,
      'user'=>$user
    ];
    return $data;
  }
  public function store($request){
    $this->title = $request->input('title');
    $this->body = $request->input('body');
    $this->user_id = $request->input('user_id');
    $this->save();
  }
  public function show($id){
    $article = Article::find($id);
    $user = $article->user;
    $data = [
      'article'=>$article,
      'user'=>$user
    ];
    return $data;
  }
  public function manage($id){
    if($id != 0){
      $user_id = $id;
    }
    elseif($id == 0){
      $user_id = auth()->user()->id;
    }
    $user=User::find($user_id);
    $articles = $user->articles;
    $data =[
      'articles' => $articles,
      'user' => $user
    ];
    return $data;
  }
  public function replace($request){
    $this->title = $request->input('title');
    $this->body = $request->input('body');
    $this->save();
    return $this;
  }
  public function remove($id){
    $article = Article::find($id);
    $article->delete();
    return $article;
  }
  public function user(){
    return $this->belongsTo('App\User');
  }
}
