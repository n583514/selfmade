@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 mt-5 text-center">
         <h5 class="my-3">新規メッセージ作成</h5>
            <div class="container mt-3">
               <form class="border" action="{{ route('message.send')}}" method="post"">
                   <div class="form-group mx-5 my-5">
                   @csrf
                        <label for="receive_id">宛名</label>
                        ここにユーザー名表示
                        <label for='comment' class='mt-2'>メッセージ内容</label>
                            <textarea class='form-control' name='comment' value=""></textarea>
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