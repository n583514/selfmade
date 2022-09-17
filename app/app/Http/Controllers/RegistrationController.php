<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    //ポートフォリオ投稿画面表示(GET送信された場合)
    public function createPostForm() {

        return view ('postform');

    }

    //ポートフォリオ新規登録用(POST送信された場合)
    public function createPost(Request $request) {

        //postインスタンス作成
        $post = new Post;

        // name属性が'image'のinputタグをファイル形式に、画像をpublic/imageに保存
        $image_path = $request->file('image')->store('public/image');
        
        $columns = ['category', 'date', 'image', 'comment'];
        foreach($columns as $column) {
            $post->$column = $request->$column;
        }
        //画像パス保存
        $post->image = basename($image_path);
        
        //ログイン中のユーザー(Auth::user)が持つ(->)ポートフォリオデータ(post)として(->)入力値を保存(save(データ)
        Auth::user()->post()->save($post);

        return redirect('/');
    }

    //ポートフォリオ編集画面表示
    public function editPostForm(Post $post) {

        return view('edit',[
            'result' =>$post,
        ]);
        
    }

    //ポートフォリオupdate
    public function editPost(Post $post, Request $request){

        $image_path = $request->file('image')->store('public/image');

        $columns = ['category', 'date', 'comment'];

        foreach($columns as $column) {
            $post->$column = $request->$column;
        }

        $post->image = basename($image_path);

        $post->save();

        return redirect('/');
    }

    //ポートフォリオ削除
    public function destroyPost(Post $post) {

        // レコードを削除
        $post->delete();

        // 削除したら一覧画面にリダイレクト
        return redirect('/');
    }
}
