<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Message;

use App\User;

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

        //モデルのインスタンスを生成し、変数に代入
        $post = new Post;

        $message = new Message;

        //ログイン中ユーザー(Auth::user)が持つ(->)ポートフォリオデータ(post)を得る(get)
        $portfolios = Auth::user()->post()->where('del_flg', '=', '0')->get();

        //ログイン中ユーザー宛のメッセージデータを得る
        $messages = $message
                    ->select('messages.id', 'messages.date', 'users.nickname')
                    ->join('users', 'users.id', 'messages.send_id')
                    ->where('receive_id', Auth::user()->id)->get()->toArray();
        
        //var_dump($messages);

        return view('mypage', [
            'portfolios' => $portfolios,
            'messages' => $messages,
        ]);
    }

    //ポートフォリオ詳細画面表示用
    public function postDetail(Post $post) {

        $detalis = $post;

        return view('detail', [
            'detalis' => $detalis,
        ]);
        
    }

    //メッセージ詳細画面
    public function messageDetail(int $id) {

        $post = new Post;

        $message = new Message;

        //ログイン中ユーザー宛のメッセージデータを得る
        $messages = $message
                    ->where('messages.id', $id)
                    ->where('receive_id', Auth::user()->id)
                    ->join('users', 'users.id', 'messages.send_id')->get()->toArray();

        return view('messagedetail', [
            'messages' => $messages,
        ]);


    }
}
