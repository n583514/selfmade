<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
    //return view('welcome');
//});

//ログイン関連の必要なルーティング情報を呼び出す
Auth::routes();

//認証機能・使用するミドルウェアの宣言、ルーティングのグループ化、どこまで適用するかを指定。
Route::group(['middleware' => 'auth'], function() {

    /*ホーム画面表示*/
    Route::get('/', [DisplayController::class, 'index']);

    /*マイページ表示用*/
    Route::get('/my_page/{id}', [DisplayController::class, 'myPage'])->name('my.page');

    /*新規ポートフォリオ登録用*/ 
    Route::get('/create_post',[RegistrationController::class,'createPostForm'])->name('create.post');
    Route::post('create_post',[RegistrationController::class,'createPost']);

    /*詳細画面 */
    Route::get('/post/{post}/detail', [DisplayController::class, 'postDetail'])->name('post.detail');

    /*編集*/
    Route::get('/edit_post/{post}',[RegistrationController::class,'editPostForm'])->name('edit.post');
    Route::post('/edit_post/{post}',[RegistrationController::class,'editPost']);

    /*削除用*/
    Route::post('/destroy_post/{post}',[RegistrationController::class,'destroyPost'])->name('destroy.post');

    /*メッセージ送信用*/
    Route::get('/message_send/{id}',[MessageController::class,'MessageSendForm'])->name('message.send');
    Route::post('/message_send/{id}',[MessageController::class,'MessageSend']);

    /*メッセージ詳細画面*/
    Route::get('/message/{id}/detail', [DisplayController::class, 'messageDetail'])->name('message.detail');

    /*お気に入り登録*/
    Route::post('/post/favo/{id}', [FavoriteController::class, 'favoritepost'])->name('favorite.post');

});

