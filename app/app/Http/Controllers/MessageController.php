<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMessage;


use App\Post;

use App\User;

use App\Message;

class MessageController extends Controller
{
    //メッセージ送信画面表示用
    public function MessageSendForm(int $id) {

        //idでpostテーブルからデータ引っ張ってきて、下記viewに宛先人のidを取得
        $user = new User;

        $receive_user = $user->find($id);
        
        return view('messageform', [
            'receiveuser' => $receive_user,
        ]);
    }

    public function MessageSend(int $id, CreateMessage $request) {

        $message = new Message;

        $message->date = $request->date;
        $message->comment = $request->comment;
        $message->send_id = $id;
        $message->receive_id = $request->receive_id;
        
        $message->save();

        return redirect('/');
    }
}
