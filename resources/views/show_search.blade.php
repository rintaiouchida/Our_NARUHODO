@extends('layouts.app')

@section('content')
<div class="row justify-content-center container">
  @foreach($contacts as $contact)
  <div class="col-md-4">
    <div class="card mb50">
      <div class="card-body">
      <h3 class='h3 book-title'>{{ $contact->theme }}</h3>
      <p class='description'>
      {{ $contact->content }}
      </p>
      <!-- ajax -->
      @if($like_model->like_exist(Auth::user()->id,$contact->id))
      <p class="favorite-marke" style="margin-bottom:50px;">
        <a class="js-like-toggle  btn btn-danger" href="" data-postid="{{ $contact->id }}">ใใใญ๐</a>
      </p>
      @else
      <p class="favorite-marke" style="margin-bottom:50px;">
        <a class="js-like-toggle btn btn-primary" href="" data-postid="{{ $contact->id }}">ใใใญใๆผใ</a>
      </p>
      @endifโ
      <!-- ajax(ใใใพใง) -->
      <p class='description'>
        ๆ็จฟๆฅ:{{ $contact->created_at }}
      </p>
      </div>
    </div>
  </div>
  @endforeach
</div>
<script>
  // ajax้ไฟก
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
      if($this[0].innerHTML === 'ใใใญใๆผใ') {
        $this[0].innerHTML = 'ใใใญ๐';
      }
      else {
        $this[0].innerHTML = 'ใใใญใๆผใ';
      }
      $this.toggleClass('btn-primary');
      $this.toggleClass('btn-danger');
    })
    .fail(function (data, xhr, err) {
      //ใใใฎๅฆ็ใฏใจใฉใผใๅบใๆใซใจใฉใผๅๅฎนใใใใใใใซใใฆใใใ
      //ใจใใใใไธ่จใฎใใใซ่จ่ฟฐใใฆใใใฐใจใฉใผๅๅฎนใ่ฉณใใใใใใพใใ็ฌ
      console.log(data);
      console.log(err);
      console.log(xhr);
      console.log('a');
    });
    return false;
  });
});
  // ajax้ไฟก(ใใใพใง)

  </script>
@endsection