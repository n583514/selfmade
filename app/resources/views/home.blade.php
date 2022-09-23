@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 my-auto text-center">
         <h5 class="my-3">新着投稿</h5>
         <div class="border card-body">
               <table class='table'>
                  <tbody>
                     @foreach($newports as $newport)
                        <tr>
                           <th scope='col'>
                              <img src="{{ asset('storage/image/' . $newport->image) }}" width="200px" height="100px" class=""/>
                           </th> 
                           <td scope='col'>{{ $newport['date'] }}</td>
                           <td scope='col'>
                              <a href="{{ route('post.detail', ['post' => $newport['id']]) }}">
                                 <button type='button' class='btn btn-outline-dark'>></button>
                              </a>

                           </td>
                     @endforeach
                        </tr>
                     
                  </tbody>
               </table>
            </div>
       </div>
       <div class="col-md-3 mt-5 text-center">
          <h5 class="my-3">検索</h5>
          <div class="border card-body">
            <form action="{{ route('post.index') }}" method="GET">
            @csrf
               <label for='keywords'>キーワード検索</label>
                  <input type="text" name="keywords"/>
               <button type="submit" class="btn btn-outline-dark mx-4 mt-3">検索</button>
            </form>
          </div>
       </div>
    </div>
</div>  

@endsection