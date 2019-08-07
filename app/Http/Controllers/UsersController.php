<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserAccount;
use App\Http\Requests\UpdateUserAccount;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
      {
          $this->middleware('checkrole');
      }
    public function index()
    {
      $user = new User;
      $users = $user->index();
      return view('users.index')->with('users', $users);
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
    public function store(StoreUserAccount $request)
    {
      $user = new User;
      return $user->store($request);
    }
    public function storeArticle(StoreBlogPost $request, $id){
      $article = new Article;
      $article->store($request, $id);
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
      $user = new User;
      $data = $user->show($id);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserAccount $request, $id)
    {
        $user = new User;
        return $user->replace($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = new User;
        return $user->remove($id);
    }
}
