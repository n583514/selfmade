@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 my-auto text-center">
         @auth
         @if (auth()->user()->role === 0)
         <h5 class="my-3">ポートフォリオ</h5>
            <a href="{{ route('self.create') }}">
               <button type='button' class='btn btn-outline-dark mb-4'>＋</button>
            </a> 
            <div class="border card-body">
               <table class='table'>
                  <tbody>
                     @foreach($portfolios as $portfolio)
                        <tr>
                           <th scope='col'>
                              <img src="{{ asset('storage/image/' . $portfolio->image) }}" width="200px" height="100px" class=""/>
                           </th> 
                           <td scope='col'>{{ $portfolio['date'] }}</td>
                           <td scope='col'>
                              <a href="{{ route('self.show', ['self' => $portfolio['id']]) }}">
                                 <button type='button' class='btn btn-outline-dark'>></button>
                              </a>

                           </td>
                     @endforeach
                        </tr>
                     
                  </tbody>
               </table>
            </div>

            @else (auth()->user() === 1)

            <h5 class="my-3">お気に入り</h5>
            <div class="border card-body">
               <table class='table'>
                  <tbody>
                     @foreach($favorites as $favorite)
                        <tr>
                           
                           <th scope='col'>
                              <img src="{{ asset('storage/image/' . $favorite['image']) }}" width="200px" height="100px" class=""/>
                           </th> 
                           <td scope='col'>{{ $favorite['nickname'] }}</td>
                           <td scope='col'>
                              <a href="{{ route('self.show', ['self' => $favorite['post_id']]) }}">
                                 <button type='button' class='btn btn-outline-dark'>></button>
                              </a>

                           </td>
                     @endforeach
                        </tr>
                     
                  </tbody>
               </table>
            </div>
            @endif
            @endauth
       </div>
       <div class="col-md-3 mt-5 text-center">
          <h5 class="my-3">message</h5>
          <div class="border card-body">
               <table class='table'>
                  <tbody>
                     @foreach($messages as $message)
                        <tr>
                           <td scope='col'>{{ $message['date'] }}</td>
                           <td scope='col'>{{ $message['nickname'] }}</td>
                           <td scope='col'>
                              <a href="{{ route('message.detail', ['id' => $message['id']]) }}">
                                 <button type='button' class='btn btn-outline-dark'>></button>
                              </a>
                           </td>   
                     @endforeach
                        </tr>
                     
                  </tbody>
               </table>
            </div>
          
       </div>
    </div>
</div>  

@endsection