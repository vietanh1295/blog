<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  public function index(){
    $articles = Article::paginate(10);
    for($i=0; $i<count($articles);$i++){
     $user_id = $articles[$i]->user_id;
     $user=User::find($user_id);
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
    $this->title=$request->input('title');
    $this->body=$request->input('body');
    $this->user_id=auth()->user()->id;
    $this->save();
  }
  public function show($id){
    $article = Article::find($id);
    $user = $article->user;
    $data =[
      'article'=>$article,
      'user'=>$user
    ];
    return $data;
  }
  public function manage(){
    $user_id = auth()->user()->id;
    $user=User::find($user_id);
    return $user->articles;
  }
  public function replace($request){
    $this->title = $request->input('title');
    $this->body= $request->input('body');
    $this->save();
    return $this;
  }
  public function user(){
    return $this->belongsTo('App\User');
  }
}
