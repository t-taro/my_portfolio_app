<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;
use App\Comment;

class PostController extends Controller
{
  // トップページの一覧データを返す処理（likeマークのステータスも一緒に渡してる）
  public function index()
  {
    $posts = Post::all()->sortByDesc('created_at');
    
    foreach($posts as $post)
    {
      $user = Post::find($post->id)->user;
      $post['user'] = $user->name;
      $post['like'] = Like::where('post_id', $post->id)->count();
      // like済みのレコード有無を確認してlikeステータスを追加
      $myLikedPost = Like::where('post_id', $post->id)->where('user_id', Auth::id())->get();
      if ($myLikedPost->isNotEmpty()){
        $post['likeState'] = 'favorite';
      } else if ($myLikedPost->isEmpty()){
        $post['likeState'] = 'favorite_border';
      }
      
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

    
    return view('top', ['posts' => $posts]);
  }
  
  // 投稿の追加処理
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
  
  // like数の増減処理をして、最新のlike数とlikeステータスを返す（like.jsからリクエストされる）
  public function like(Request $request)
  {
    $alreadyLike = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->get();
    $post = Post::find($request->post_id);
    
    // 既にlikeしたpostか否かの判定
    if ($alreadyLike->isEmpty()){
      // ログイン済み and 自分のpostにlikeしてないかの判定
      if(Auth::user() && $post->user_id != Auth::id()){
        $postData = [
          'post_id' => $request->post_id,
          'user_id' => Auth::id()
        ];
        
        $postItem = Like::create($postData);
        
        $likeCount = Like::where('post_id', $request->post_id)->count();
        
        return response()->json(['like' => $likeCount, 'state' => 'plus']);
      }else{
        return response()->json(['like' => 'noResult']);
      };
    }else{
      // 既にlikeしたpostを再likeした場合の処理
      if(Auth::user() && $post->user_id != Auth::id()){
        
        Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->delete();
        
        $likeCount = Like::where('post_id', $request->post_id)->count();
        
        return response()->json(['like' => $likeCount, 'state' => 'minus']);
      }else{
        return response()->json(['like' => 'noResult']);
      };
      
    }

  }
  
  // 更新ページに既存データを渡す
  public function show($id)
  {
    $post = Post::findOrFail($id);
    return view('posts/update', ['post' => $post]);
  }
  
  // 更新処理
  public function update(Request $request, $id)
  {
    $post = Post::findOrFail($id);
    $post->fill($request->all())->save();
    return redirect("/");
  }
  
  // 削除処理
  public function delete($id)
  {
    $post = Post::findOrFail($id)->delete();
    return redirect("/");
  }
  
}
