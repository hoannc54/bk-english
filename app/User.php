<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//    public $timestamps = false;
    
    public function learning() {
        return $this->hasOne('App\Learning', 'user_id');
    }
    public function learned() {
        return $this->hasOne('App\Learned', 'user_id');
    }
    public function learnt() {
        return $this->hasOne('App\Learnt', 'user_id');
    }
    public function not_learn() {
        return $this->hasOne('App\NotLearn', 'user_id');
    }
}
