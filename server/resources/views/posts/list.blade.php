@extends('layouts.app')

@section('content')
  <div class="container">
      <section id="postList">
        <ul>
          @foreach($posts as $post)
            <li class="postItem" data-post-id="{{$post->id}}">
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
                  <span class="commentCount">10</span>
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      </section>
  </div>
@endsection
