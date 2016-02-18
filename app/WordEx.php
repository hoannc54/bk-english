<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordEx extends Model {

    protected $table = 'word_exes';
    protected $fillable = ['id_word', 'id_example'];
}
