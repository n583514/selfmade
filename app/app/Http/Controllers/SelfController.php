<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Message;

use App\Favorite;

use App\User;

use App\Http\Requests\CreatePost;

class SelfController extends Controller
{

     /* ログイン認証をedit,update,destroyにだけかける
     public function __construct()
     {
         $this->middleware('auth', ['only' => ['create','edit', 'update', 'destroy','show','store']]);
     }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // TOPページの表示
    public function index(Request $request)
    {
        $title = '新着投稿';

        //キーワード取得
        $keywords = $request->input('keywords');

        //カテゴリ取得
        $keycategorys = $request->input('keycategorys');

        $query = Post::query();

        //キーワード検索
        if(!empty($keywords)) {
            $query->where('comment', 'like', '%' .$keywords. '%');
            $title = '検索結果';
        }
        //カテゴリ検索
        if(!empty($keycategorys)) {
            $query->where('category', $keycategorys);
            if($keycategorys == '1') {
                $category = 'アイコン';
            }elseif($keycategorys == '2') {
                $category = 'Webデザイン';
            }else {
                $category = 'その他';
            }
            $title = '検索結果'; 
        }

        $posts = $query->orderBy('date', 'desc')->get();

        return view('home', [
            'posts' => $posts,
            'keywords' => $keywords, 
            'title' => $title,
        ]);
    }

    // 新規投稿作成ページの表示

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('postform');
    }

    // 作成した投稿を保存

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePost $request)
    {
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

    // 投稿の個別ページ表示

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalis = Post::findOrFail($id);

        $favorite_model = new Favorite;

        return view('detail', [
            'detalis' => $detalis,
            'favorite_model' => $favorite_model,
        ]);
    }

    // 投稿編集ページを表示

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Post::findOrFail($id);

        if($result->user_id == auth()->id()){
            return view('edit')->with('result',$result);
        }else{
            return redirect('/');
        }

        /*return view('edit',[
            'result' =>$result,
        ]);*/
    }

    // 編集した投稿を上書き保存

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CreatePost $request)
    {

        $post = Post::findOrFail($id);

        $image_path = $request->file('image')->store('public/image');

        $columns = ['category', 'date', 'comment'];

        foreach($columns as $column) {
            $post->$column = $request->$column;
        }

        $post->image = basename($image_path);

        $post->save();

        return redirect('/');
    }

    // 投稿を削除

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->user_id == auth()->id()){
            $post->delete();
            return redirect('/');
        }else{
            return redirect('/');
        }

        /*// レコードを削除
        $post->delete();

        // 削除したら一覧画面にリダイレクト
        return redirect('/');*/
    }
}
