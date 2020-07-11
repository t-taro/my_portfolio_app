@extends('layouts.app')

@section('content')
  <div class="container">
      <section id="postList">
        <ul>
          @foreach($posts as $post)
            <li class="postItem">
              <h1 class="snackName">{{$post->item}}</h1>
              <p class="desc">{!! nl2br(e($post->description)) !!}</p>
              <p class="age">年齢</p>
              <p>{{$post->user}}</p>
            </li>
          @endforeach
        </ul>
      </section>
  </div>
@endsection
