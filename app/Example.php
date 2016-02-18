<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model {

    protected $table = 'examples';
    protected $fillable = ['id', 'example', 'mean'];
//    public $timestamps = false;

    public function word() {
        return $this->belongsToMany('App\Word', 'word_exes');
    }

}
