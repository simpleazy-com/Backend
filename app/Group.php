<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    public function admin(){
        return $this->belongsTo('App\Admin');
    }

    public function member(){
        return $this->hasMany('App\Member');
    }
}
