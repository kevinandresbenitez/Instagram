<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model{
    use HasFactory;
    protected $table ='likes';

    public function publications(){
      return $this->belongsTo('App\Models\Publication','publication_id');
    }

    public function users(){
      return $this->belongsTo('App\Models\User','user_id');
    }

}
