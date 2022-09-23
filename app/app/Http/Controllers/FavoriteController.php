<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Favorite;

use App\User;

class FavoriteController extends Controller{

    //お気に入り登録
    public function favoritepost(int $id) {

        $favorite = new Favorite;

        $ymd = date('Y-m-d');

        $favorite->date = $ymd;
        $favorite->post_id = $id;

        Auth::user()->favorite()->save($favorite);

        return back();

    }

    //お気に入り削除
    public function favoritedestroy(int $id) {

        $favorite = new Favorite;

        $record = $favorite->where('post_id', $id)->where('user_id', Auth::user()->id)->delete();
        
        /*$record->del_flg = '1';

        $record->save();*/

        return back();

    }
}
