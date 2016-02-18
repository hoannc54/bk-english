<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotLearn extends Model {

    protected $table = 'not_learns';
    protected $fillable = ['id_user', 'list_id_word'];
//    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

}
