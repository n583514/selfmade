@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 mt-3 text-center">
            <div class="card-body">
                <img src="{{ asset('storage/image/' . $detalis->image) }}" width="350px" height="200px" class=""/>
            </div>
       </div>
       <div class="col-md-5 my-auto text-center">
          <div class="card-body">
            <p>{{ $detalis->date }}</p>
            <p>{{ $detalis->comment }}</p>
            <p>？？？？？？？？？？？？？？？？？？？？？？</p>
          </div>
       </div>
    </div>
    <div class='d-flex justify-content-center mt-5'>
        <a href="{{ route('edit.post', ['post' => $detalis['id']]) }}">
            <button class='btn btn btn-outline-dark mx-4'>編集</button>
        </a> 
        <form action="{{ route('destroy.post', ['post' => $detalis['id']]) }}" method="POST">
        @csrf
            <button type="submit" class="btn btn-outline-danger mx-4">削除</button>
        </form>
        <a href="{{ route('message.send') }}">
        <button type="submit" class="btn btn-outline-dark mx-4">✉</button>
        </a> 
        
    </div> 
</div>  

@endsection