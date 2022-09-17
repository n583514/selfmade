@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 mt-5 text-center">
         <h5 class="my-3">ポートフォリオ編集</h5>
            <div class="container mt-3">
               <form class="border" action="{{ route('edit.post', ['post' =>$result['id']])}}" method="post" enctype="multipart/form-data">
                   <div class="form-group mx-5 my-5">
                   @csrf
                        <label for="category">カテゴリ</label>
                           <select name='category' class='form-control'>
                               <option value='0'>アイコン</option>
                               <option value='1'>Webデザイン</option>
                               <option value='2'>その他</option>
                            </select>
                        <label for='image'>画像</label>
                            <input type="file" name="image" id='image' value="{{ $result['image']}}"/>
                        <label for='date' class='mt-2'>日付</label>
                            <input type='date' class='form-control' name='date' id='date' value="{{ $result['date']}}"/>
                        <label for='comment' class='mt-2'>コメント</label>
                            <textarea class='form-control' name='comment'>{{ $result['comment']}}</textarea>
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn btn-outline-dark w-25 mt-3'>登録</button>
                        </div> 
                   </div>
                </form>
            </div>
       </div>
      
    </div>
</div>  

@endsection