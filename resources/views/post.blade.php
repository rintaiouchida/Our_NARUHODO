@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>投稿内容</h1>
<div class="row justify-content-center container">
    <div class="col-md-10">
      <form method='POST' action="/store" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
              @if(session()->has('successRegister'))
              <div class="success-alert">
                {{ session()->get('successRegister') }}
              </div>
              @endif
              <div class="form-group">
                <label for="thema">テーマ</label>
                <input id="thema" type='text' class='form-control' name='thema' placeholder='テーマを入力'>
              </div>

              <div class="form-group">
              <label for="content">内容</label>
                <textarea id="content" class='form-control' name='content' placeholder='内容を入力'></textarea>
              </div>
          
              <input type='submit' class='btn btn-primary' value='登録'>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection