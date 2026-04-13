<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
