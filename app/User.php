<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Article;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function index(){
      $users = User::orderBy('created_at','DESC')->get();
      return $users;
    }
    public function store($request){
      $this->name = $request->input('name');
      $this->email = $request->input('email');
      $this->role_id = $request->input('role_id');
      $this->password = Hash::make($request->input('password'));
      $this->save();
      return $this;
    }
    public function show($id){
      $article = new Article;
      $data = $article->manage($id);
      return $data;
    }
    public function remove($id){
      $user=User::find($id);
      $articles = $user->articles;
      foreach($articles as $article){
        $article->delete();
      }
      $user->delete();
      return $user;
    }
    public function articles(){
      return $this->hasMany('App\Article')->orderBy("created_at","DESC");
    }
}
