<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Favorite;

use App\User;

use Log;

use Response;

class FavoriteController extends Controller{

    //お気に入り登録
    public function like(Request $request) {

        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $post_id = $request->id; //2.投稿idの取得
        $already_liked = Favorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $favorite = new Favorite; //4.インスタンスを作成
            $favorite->post_id = $post_id; //インスタンスにpost_id,user_idをセット
            $favorite->user_id = $user_id;
            $ymd = date('Y-m-d');
            $favorite->date = $ymd;
            $favorite->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdel_flg変更
            //Favorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
            $favorite = new Favorite;
            $record = $favorite->where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
            if($record->del_flg == '1') {
                $record->del_flg = '0';
            }else {
                $record->del_flg = '1';
            }
            $record->save();
        }

        $favorites = [
            'favorite' => $favorite,
        ];
        Log::debug($request);

        return response()->json($favorites);


        /*$favorite = new Favorite;

        $ymd = date('Y-m-d');

        $favorite->date = $ymd;
        $favorite->post_id = $id;

        Auth::user()->favorite()->save($favorite);

        return back();*/

    }

}
