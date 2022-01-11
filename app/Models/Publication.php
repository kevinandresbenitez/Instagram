<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model{
    use HasFactory;

    protected $table = 'publications';


    public function comments(){
      return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
    }

    public function likes(){
      return $this->hasMany('App\Models\Like');
    }

    public function users(){
      return $this->belongsTo('App\Models\User','user_id');
    }

}
