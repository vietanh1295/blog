<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Http\Requests\StoreBlogPost;
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
      $article = new Article;
      $articles = $article->show();
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
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
      $validated = $request->validated();
      $article = new Article;
      $article->title=$request->input('title');
      $article->body=$request->input('body');
      $article->user_id=auth()->user()->id;

      $article->save();
      return $article;
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
    public function manage(){
      $user_id = auth()->user()->id;
      $user=User::find($user_id);
      $articles=$user->articles;
      // var_dump($articles);
      return view('articles.manage')->with('articles',$articles);
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
    public function update(StoreBlogPost $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->body= $request->input('body');
        $article->save();
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
    }
}
