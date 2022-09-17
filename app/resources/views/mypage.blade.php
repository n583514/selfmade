@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 my-auto text-center">
         <h5 class="my-3">ポートフォリオ</h5>
            <a href="{{ route('create.post') }}">
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
                              <a href="{{ route('post.detail', ['post' => $portfolio['id']]) }}">
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
          <h5 class="my-3">message</h5>
          <div class="">
            <p class="border">？？</p>
          </div>
       </div>
    </div>
</div>  

@endsection