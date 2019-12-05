<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $guarded = [];
    
    // Order belongs to User
    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
