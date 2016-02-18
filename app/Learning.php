<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learning extends Model {

    protected $table = 'learnings';
    protected $fillable = ['id_user', 'list_id_word'];
//    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

}
