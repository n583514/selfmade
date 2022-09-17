<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class MessageController extends Controller
{
    //メッセージ送信画面表示用
    public function MessageSendForm() {

        
        return view ('messageform');
    }
}
