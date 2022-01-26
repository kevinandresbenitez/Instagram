<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Publication extends Model{
    use HasFactory;

    protected $table = 'publications';


    /*Add default order by */
    protected static function boot(){
        parent::boot();
     
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }



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
