<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected function transactions()
    {
        return $this->belongsToMany(Transaction::class, "category_details");
    }
}
