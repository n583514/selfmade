@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 mt-5 text-center">
         <h5 class="my-3">ポートフォリオ投稿</h5>
            <div class="container mt-3">
                <div class='panel-body'>
                    @if($errors->any())
                    <div class='alert alert-danger'>
                        <ul>
                            @foreach($errors->all() as $messages)
                            <li>{{ $messages }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
               <form class="border" action="{{ route('create.post')}}" method="post" enctype="multipart/form-data">
                   <div class="form-group mx-5 my-5">
                   @csrf
                        <label for="category">カテゴリ</label>
                           <select name='category' class='form-control'>
                               <option value='1'>アイコン</option>
                               <option value='2'>Webデザイン</option>
                               <option value='3'>その他</option>
                            </select>
                        <label for='image'>画像</label>
                            <input type="file" name="image" id='image' value="{{ old('image')}}"/>
                        <label for='date' class='mt-2'>日付</label>
                            <input type='date' class='form-control' name='date' id='date' value="{{ old('date')}}"/>
                        <label for='comment' class='mt-2'>コメント</label>
                            <textarea class='form-control' name='comment' value="{{ old('comment')}}"></textarea>
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