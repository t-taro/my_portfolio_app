<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::all()->sortByDesc('created_at');
    
    foreach($posts as $post)
    {
      $user = Post::find($post->id)->user;
      $post['user'] = $user->name;
    }
    
    return view('top', ['posts' => $posts]);
  }
  
  public function store(Request $request)
  {
    if ($request->item){
      $postData = [
        'item' => $request->item,
        'description' => $request->description,
        'user_id' => Auth::id()
      ];
      
      $postItem = Post::create($postData);
    }
    
    return redirect("/");
  }
  
  public function like(Request $request)
  {
    $post = Post::find($request->id);
    $post->like = $request->like;
    
    $post->save();
    
    return response()->json(['like' => $request->like]);
  }
}
