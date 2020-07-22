<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['item', 'description', 'user_id', 'like'];
  
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  
  public function comment()
  {
    return $this->hasMany('App\Comment');
  }
}
