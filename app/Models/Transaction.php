<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    protected function user(){
        return $this->belongsTo(User::class);
    }

    protected function categorydetails(){
        return $this->hasMany(Category::class);
    }
}
