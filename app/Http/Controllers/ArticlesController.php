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
    $article = new Article();
    $articles = $article->index();
    return view('articles.index')->with('articles',$articles);
  }
  public function userArticle($id){
    $article = new Article;
    $data = $article->userArticle($id);
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
    $article->store($request);
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
    $article = new Article;
    $data = $article->show($id);
    return view('articles.show')->with($data);
  }
  public function manage(){
    $article = new Article;
    $data = $article->manage(0);
    return view('articles.manage')->with($data);
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
    $article=Article::find($id);
    $newArticle=$article->replace($request);
    return $newArticle;
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $article = new Article;
    return $article->remove($id);
  }
}
