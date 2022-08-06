<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected static $unguarded = true;
    protected $perPage = 20;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    public function getStatusChange()
    {
        if($this->is_update_status
//            && $this->user->isAdmin()
        ) {
            return "Status was changed to {$this->status->name}";
        }
        return null;
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
