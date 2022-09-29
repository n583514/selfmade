@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-around">
       <div class="col-md-5 my-auto text-center">
         <h5 class="my-3">{{ $title }}</h5>
         <div class="border card-body">
               <table class='table'>
                  <tbody>
                     @forelse($posts as $post)
                        <tr>
                           <th scope='col'>
                              <img src="{{ asset('storage/image/' . $post->image) }}" width="200px" height="100px" class=""/>
                           </th> 
                           <td scope='col'>{{ $post['date'] }}</td>
                           <td scope='col'>
                              <a href="{{ route('self.show', ['self' => $post['id']]) }}">
                                 <button type='button' class='btn btn-outline-dark'>></button>
                              </a>
                           </td>
                        </tr>
                     @empty
                           <p>該当なし</p>       
                     @endforelse
                        </tr>
                     
                  </tbody>
               </table>
            </div>
       </div>
       <div class="col-md-3 mt-5 text-center">
          <h5 class="my-3">検索</h5>
          <div class="border card-body">
            <form action="{{ route('post.index') }}" method="GET">
               <label for='keywords'>キーワード</label>
                  <input type="text" name="keywords" value=""/>

               <label for='keycategorys' class='mt-3'>カテゴリ</label>
                  <select name='keycategorys' class='form-control'>
                     <option value='0'>選択してください</option>
                     <option value='1'>アイコン</option>
                     <option value='2'>Webデザイン</option>
                     <option value='3'>その他</option>
                  </select>
               <button type="submit" class="btn btn-outline-dark mx-4 mt-3">検索</button>
            </form>

          </div>
       </div>
    </div>
</div>  

@endsection