@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-5 mt-5 text-center">
         <h5 class="my-3">メッセージ詳細</h5>
            <div class="container mt-3 border">
            @foreach($messages as $message)
                   <div class="form-group mx-5 my-5">
                        @csrf
                        <label for="">送信者</label>
                            <p>{{ $message['nickname'] }}</p>
                        <label for='' class='mt-2'>日付</label>
                            <p>{{ $message['date'] }}</p> 
                        <label for='' class='mt-2'>メッセージ</label>
                            <p>{{ $message['comment'] }}</p>
                   </div>
            </div>
            @endforeach
            <div class=' justify-content-center'>
                <a href="{{ route('message.send', ['id' => $message['send_id']]) }}">
                <button type='submit' class='btn btn-outline-dark w-25 mt-3'>返信</button>
            </div> 
       </div>
      
    </div>
</div>  

@endsection