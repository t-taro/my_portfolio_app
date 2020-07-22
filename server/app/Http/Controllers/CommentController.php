<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
  public function store(Request $request, $id)
  {    
    if ($request->comment){
      $postData = [
        'comment' => $request->comment,
        'post_id' =>  $id,
        'user_id' => Auth::id()
      ];
      
      $postItem = Comment::create($postData);
    }
    
    return redirect("/");
  }
}
