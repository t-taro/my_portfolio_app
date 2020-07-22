@extends('layouts.app')

@section('content')
  <div class="container">
    <section>
      <!-- 更新データ送信 -->
      <section id="newPostArea" class="mb-3 w-50">
        <div class="formWrap">
          <form action="/post/update/{{$post->id}}" method="POST" class="d-flex flex-column">
            @method('PUT')
            @csrf
            <label for="item_name" class="m-0">Item</label>
            <input type="text" name="item" id="item_name" class="form-control mb-1" value="{{$post->item}}">
            <label for="item_desc" class="m-0">Description</label>
            <textarea name="description" id="item_desc" class="form-control mb-2" cols="30" rows="3">{{$post->description}}</textarea>
            <input type="submit" value="Add post" class="btn btn-warning">
          </form>
        </div>
      </section>
    </section>
  </div>

@endsection