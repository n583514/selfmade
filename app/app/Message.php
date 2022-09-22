<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $fillable = ['comment', 'date', 'send_id', 'receive_id'];

    public function sender() {
        return $this->belongsToMany('App\User', 'send_id');
    }

    public function receiver() {
        return $this->belongsToMany('App\User', 'receive_id');
    }
}
