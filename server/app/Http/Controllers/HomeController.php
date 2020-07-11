<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $posts = Post::where('user_id', Auth::id())
                            ->orderBy('updated_at', 'desc')
                            ->get();
      
      foreach($posts as $post)
      {
        $post['user'] = Auth::user()->name;
      }
      
      return view('posts/list', ['posts'=>$posts]);
    }
}
