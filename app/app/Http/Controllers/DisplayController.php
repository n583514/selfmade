<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

class DisplayController extends Controller
{
    public function index() {

        $posts = new Post;

        $newports = $posts->where('del_flg', '=', '0')->get();


        return view('home', [
            'newports' => $newports,
        ]);
    }

    //マイページ表示用
    public function myPage(int $id) {

        //モデルのインスタンスを生成し、変数postに代入
        $post = new Post;

        //ログイン中ユーザー(Auth::user)が持つ(->)ポートフォリオデータ(post)を得る(get)
        $portfolios = Auth::user()->post()->where('del_flg', '=', '0')->get();


        return view('mypage', [
            'portfolios' => $portfolios,
        ]);
    }

    //ポートフォリオ詳細画面表示用
    public function postDetail(Post $post) {

        $detalis = $post;

        return view('detail', [
            'detalis' => $detalis,
        ]);
        
    }
}
