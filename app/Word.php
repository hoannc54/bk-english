<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {

    protected $table = 'words';
    protected $fillable = ['id', 'word', 'spell', 'mean', 'type', 'sound', 'example', 'mean_ex', 'parent_id'];

//    public $timestamps = false;

//    public function examples() {
//        return $this->belongsToMany('App\Example', 'word_exes');
//    }

}
