@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- @guest -->
    <header class="mb-3">
      <section id="top_main">
        @guest
        <div id="title_message">
          <h1 id="title" class="mb-3">3 O'clock</h1>
          <p>おやつの時間。それは子供たちが笑顔になるじかん。今日はどんなおやつを食べるのかな？お気に入りを見つけたらみんなに教えてあげよう！！</p>
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
      
      <!-- 記事リスト -->
      
      <section id="postList">
        <ul class="list-group">
          @foreach($posts as $post)
          <li class="postItem list-group-item list-group-item-warning" data-post-id="{{$post->id}}">
            <h1 class="snackName">{{$post->item}}</h1>
            <!-- nl2brで改行コードを変換 -->
            <p class="desc">{!! nl2br(e($post->description)) !!}</p>
            <p class="age">年齢</p>
            <p>{{$post->user}}</p>
            <p>{{$post->created_at}}</p>
            <div class="assessment">
                <p class="mr-3">
                  <span class="like material-icons md-18">favorite_border</span>
                  <span class="likeCount">{{$post->like}}</span>
                </p>
                <p><span class="comment material-icons md-18">chat_bubble_outline</span><span class="commentCount">10</span></p>
              </div>
          </li>
          @endforeach
        </ul>
      </section>
      
    </section>
  </div>

@endsection