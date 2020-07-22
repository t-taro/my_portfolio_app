@extends('layouts.app')

@section('content')
  <div class="container">
      <section id="postList">
       <ul class="list-group">
          @foreach($posts as $post)
            <li class="postItem list-group-item list-group-item-warning" data-post-id="{{$post->id}}">
              <h1 class="snackName">{{$post->item}}</h1>
              <p class="desc">{!! nl2br(e($post->description)) !!}</p>
              <p class="age">年齢</p>
              <p>{{$post->user}}</p>
              <p>{{$post->created_at}}</p>
              <div class="assessment">
                <p class="mr-3">
                  <span class="like material-icons md-18">favorite_border</span>
                  <span class="likeCount">{{$post->like}}</span>
                </p>
                <p>
                  <span class="comment material-icons md-18">chat_bubble_outline</span>
                  <span class="commentCount">{{$post->commentCount}}</span>
                </p>
              </div>
              
              <!-- 自分のpostに対してのみ更新、削除が実施可能 -->
              @if($post->user_id === Auth::id())
              <div class="update_delete_button">
                <a href="/post/show/{{$post->id}}"><button class="btn btn-info">update</button></a>
                <form action="/post/delete/{{$post->id}}" method="post" class="ml-2">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-info">delete</button>
                </form>
              </div>
              @endif
              
              <!-- コメント欄 -->
              <div class="comment_area commentFormWrap closed" data-comment-count="{{$post->commentCount}}">
                @auth
                <form action="/comment/{{$post->id}}" method="post">
                  @csrf
                  <input type="text" name="comment">
                  <input type="submit" value="add comment">
                </form>
                @endauth
                <ul class="list-group">
                  @foreach($post->comments as $comment)
                  <li class="comment_list list-group-item">
                    <p>{{$comment->comment}}</p>
                    <p>{{$comment->user}}</p>
                    <p>{{$comment->created_at}}</p>
                  </li>
                  @endforeach
                </ul>
              </div>
            </li>
          @endforeach
        </ul>
      </section>
  </div>
@endsection
