<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function like(){
        return $this->hasMany(User::class,'likes','post_id','user_id');
    }
}
