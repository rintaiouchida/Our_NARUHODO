@extends('layouts.app')
@section('content')
<h1 class='pagetitle'>いいね一覧</h1>
<div class="row justify-content-center container">
  @foreach($likes as $like)
  <div class="col-md-4">
    <div class="card mb50">
      <div class="card-body">
        <h3 class='h3 book-title'>{{ $like->theme }}</h3>
        <p class='description'>
        {{ $like->content }}
        </p>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection