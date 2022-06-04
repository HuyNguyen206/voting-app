<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected static $unguarded = true;

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
}

