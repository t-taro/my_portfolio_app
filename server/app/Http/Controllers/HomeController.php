<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;
use App\Comment;

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
                            ->latest()
                            ->get();
      
      foreach($posts as $post)
      {        
        $post['user'] = Auth::user()->name;
        $post['like'] = Like::where('post_id', $post->id)->count();
        
        // $postに紐づくコメントを取得
        $comments = Post::find($post->id)->comment->sortByDesc('created_at');
        
        // コメント欄のheightを決めるために使用
        $post['commentCount'] = Comment::where('post_id', $post->id)->count();
        
        // コメントしたユーザー情報を紐付け
        foreach($comments as $comment)
        {
          $commentUser = Comment::find($comment->id)->user;
          $comment['user'] = $commentUser->name;
        }
        
        $post['comments'] = $comments;
        
        $commentCount = Post::find($post->id)->comment->count();
        $post['commentCount'] = $commentCount;
      }
      
      return view('posts/list', ['posts'=>$posts]);
    }
}
