<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['date', 'post_id', 'del_flg'];

    public function user() {
        return $this->belongsToMany('App\User');
    }
}
