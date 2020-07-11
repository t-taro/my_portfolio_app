<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/material_icons.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/new_post_popup.css') }}">
  <title>3 O'clock</title>
</head>
<body>
  <div class="container">
    <header class="mb-3">
      @guest
      <section id="top_main">
        <div id="title_message">
          <h1 id="title" class="mb-3">3 O'clock</h1>
          <p>おやつの時間。それは子供たちが笑顔になるじかん。今日はどんなおやつを食べるのかな？お気に入りを見つけたらみんなに教えてあげよう！！</p>
        </div>
      @else
      <section>
        
        
      
      @endguest
        
        @if (Route::has('login'))
        <div class="auth_menu"">
          @auth
          <a href="{{ url('/home') }}">Home</a>
          @else
          <a href="{{ route('login') }}" class="mb-1"><input type="button" class="btn btn-primary" value="Let's Login!"></a>
          @if (Route::has('register'))
          <a href="{{ route('register') }}">新規アカウント作成はこちら</a>
          @endif
          @endauth
        </div>
        @endif
      </section>
    </header>
    <main>
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
          <li class="postItem list-group-item list-group-item-warning">
            <h1 class="snackName">{{$post->item}}</h1>
            <!-- nl2brで改行コードを変換 -->
            <p class="desc">{!! nl2br(e($post->description)) !!}</p>
            <p class="age">年齢</p>
            <p>{{$post->user}}</p>
          </li>
          @endforeach
        </ul>
      </section>
      
    </main>
    
  </div>
  <script src="{{ asset('js/new_post_area.js') }}"></script>
</body>
</html>