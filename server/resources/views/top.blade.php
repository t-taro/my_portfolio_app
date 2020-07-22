@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- @guest -->
    <header class="mb-3">
      <section id="top_main">
        @guest
        <div id="title_message">
          <h1 id="title" class="mb-3">3 O'clock</h1>
          <p>おやつの時間。今日はどんなおやつを食べたかな？お気に入りを見つけたらみんなに教えてあげよう！！</p>
        </div>
        @endguest
        
        @if (Route::has('login'))
        <div class="auth_menu">
          <a href="{{ route('login') }}" class="mb-1"><input type="button" class="btn btn-primary" value="Let's Login!"></a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}">新規アカウント作成はこちら</a>
            @endif
        </div>
        @endif
      </section>
    </header>
    <!-- @endguest -->
    <section>
      <!-- 新規追加 -->
      @auth
      <h1 id="letsNew"><span class="material-icons">create</span>お気に入りのおやつを教えてね</h1>
      <section id="newPostArea" class="mb-3 w-50">
        <div class="formWrap closed">
          <form action="/post" method="post" class="d-flex flex-column">
            @csrf
            <label for="item_name" class="m-0">Item</label>
            <input type="text" name="item" id="item_name" class="form-control mb-1">
            <label for="item_desc" class="m-0">Description</label>
            <textarea name="description" id="item_desc" class="form-control mb-2" cols="30" rows="3"></textarea>
            <input type="submit" value="Add post" class="btn btn-warning">
          </form>
        </div>
      </section>
      @endauth
      
      <!-- 記事リスト -->
      <!-- liの要素が増減したときはcomment.jsも修正が必要（子要素の○番目と指定している為） -->
      
      <section id="postList">
        <ul class="list-group">
          @foreach($posts as $post)
          <li class="postItem list-group-item list-group-item-warning" data-post-id="{{$post->id}}">
            <h1 class="snackName">{{$post->item}}</h1>
            <!-- nl2brで改行コードを変換 -->
            <p class="desc">{!! nl2br(e($post->description)) !!}</p>
            <p>{{$post->user}}</p>
            <p>{{$post->created_at}}</p>
            <div class="assessment">
              <p class="mr-3">
                <span class="like material-icons md-18">{{$post->likeState}}</span>
                <span class="likeCount">{{$post->like}}</span>
              </p>
              <p><span class="comment material-icons md-18">chat_bubble_outline</span><span class="commentCount">{{$post->commentCount}}</span></p>
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
      
      
    </section>
  </div>

@endsection