<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learnt extends Model {

    protected $table = 'learnts';
    protected $fillable = ['id_user', 'list_id_word'];
//    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

}
