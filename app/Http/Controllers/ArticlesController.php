<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
      {
          $this->middleware('auth')->except(['index','userArticle','show']);
      }
    public function index()
    {
      $articles = Article::paginate(10);
      for($i=0; $i<count($articles);$i++){
       $user_id = $articles[$i]->user_id;
       $user=User::find($user_id);
       $name = $user->name;
       $articles[$i]->author = $name;
      }
      return view('articles.index')->with('articles',$articles);
    }
    public function userArticle($id){
      $user = User::find($id);
      $articles = $user->articles;
      $data = [
        'articles'=>$articles,
        'user'=>$user
      ];
      return view('articles.userArticle')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $article = Article::find($id);
      $user = $article->user;
      $data =[
        'article'=>$article,
        'user'=>$user
      ];
      return view('articles.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
