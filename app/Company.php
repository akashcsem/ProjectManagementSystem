<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
      'name',
      'description',
      'user_id'
    ];

    public function company () {
        return $this->belongsTo('App\Company');
    }
    public function projects () {
        return $this->hasMany('App\Project');
    }

    public function comments () {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
