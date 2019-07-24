<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'name',
      'description',
      'company_id',
      'project_id',
      'user_id',
      'days',
      'hours'
    ];

    public function user () {
        return $this->belongsTo('App\User');
    }
    // for task user
    public function users () {
        return $this->belongsToMany('App\User');
    }
    public function company () {
        return $this->belongsTo('App\Company');
    }
    public function project () {
        return $this->belongsTo('App\Project');
    }

    public function comments () {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
