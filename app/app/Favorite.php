<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['date', 'post_id', 'del_flg'];

    public function user() {
        return $this->belongsToMany('App\User');
    }

    public function post() {
        return $this->belongsToMany('App\Post');
    }

    public function favo_exist($user_id, $id) {


        $exist = Favorite::where('post_id', $id)->where('user_id', $user_id)->where('del_flg', '=', '0')->get();

        //レコード($exist)が存在するなら
        if(!$exist->isEmpty()) {
            return true;
        }else {
        //レコード($exsit)が存在しないなら    
            return false;
        }
    }
}
