<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  public function show(){
    $articles = Article::paginate(10);
    for($i=0; $i<count($articles);$i++){
     $user_id = $articles[$i]->user_id;
     $user=User::find($user_id);
     $name = $user->name;
     $articles[$i]->author = $name;
    }
    return $articles;
  }
  
  public function insert(){

  }
  public function user(){
    return $this->belongsTo('App\User');
  }
}
