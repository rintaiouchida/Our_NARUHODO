@extends('layouts.app')

@section('content')
<div class="row justify-content-center container">
  @foreach($posts as $post)
  <div class="col-md-4">
    <div class="card mb50">
      <div class="card-body">
      <h3 class='h3 book-title'>{{ $post->theme }}</h3>
      <p class='description'>
      {{ $post->content }}
      </p>
      <!-- ajax -->
      @if($like_model->like_exist(Auth::user()->id,$post->id))
      <p class="favorite-marke" style="margin-bottom:50px;">
        <a class="js-like-toggle  btn btn-danger" href="" data-postid="{{ $post->id }}">いいね👍</a>
        <span class="likesCount">{{$post->like_count}}</span>
      </p>
      @else
      <p class="favorite-marke" style="margin-bottom:50px;">
        <a class="js-like-toggle btn btn-primary" href="" data-postid="{{ $post->id }}">いいねを押す</a>
      </p>
      @endif​
      <!-- ajax(ここまで) -->
      <p class='description'>
        投稿日:{{ $post->created_at }}
      </p>
      </div>
    </div>
  </div>
  @endforeach
</div>
<script>
  // ajax通信
  $(function(){
  var like=$('.js-like-toggle');
  var likePostId;

  like.on('click',function(){
    var $this=$(this);
    likePostId=$this.data('postid');

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    $.ajax({
      url:'/ajaxlike',
      type:'POST',
      data:{
        'post_id':likePostId
      },
    })

    .done(function(data){
      console.log($this[0].innerHTML);
      if($this[0].innerHTML === 'いいねを押す') {
        $this[0].innerHTML = 'いいね👍';
      }
      else {
        $this[0].innerHTML = 'いいねを押す';
      }
      $this.toggleClass('btn-primary');
      $this.toggleClass('btn-danger');
    })
    .fail(function (data, xhr, err) {
      //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
      //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
      console.log(data);
      console.log(err);
      console.log(xhr);
      console.log('a');
    });
    return false;
  });
});
  // ajax通信(ここまで)

  </script>
@endsection