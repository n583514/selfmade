<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Favorite;

use App\User;

class FavoriteController extends Controller{

    //お気に入り登録
    public function like(Request $request) {

        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $post_id = $request->post_id; //2.投稿idの取得
        $already_liked = Favorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $favorite = new Favorite; //4.Likeクラスのインスタンスを作成
            $favorite->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
            $favorite->user_id = $user_id;
            $favorite->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Favorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }

        $favorites = [
            'favorite' => $favorite,
        ];

        return response()->json($favorites);

        

        

        /*$favorite = new Favorite;

        $ymd = date('Y-m-d');

        $favorite->date = $ymd;
        $favorite->post_id = $id;

        Auth::user()->favorite()->save($favorite);

        return back();*/

    }

    //お気に入り削除
    public function favoritedestroy(int $id) {

        $favorite = new Favorite;

        $record = $favorite->where('post_id', $id)->where('user_id', Auth::user()->id)->first();
        
        $record->del_flg = '1';

        $record->save();

        return back();

    }
}
