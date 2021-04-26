@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>あなたが欲しい「なるほど」を探そう</h1>
<div class="row justify-content-center container">
    <div class="col-md-10">
      <form method='POST' action="/show_search" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="keyword">キーワード</label>
                <input id="keyword" type='text' class='form-control' name='keyword' placeholder='キーワードを入力'>
              </div>

              <input type='submit' class='btn btn-primary' value='検索'>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
