<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Idea extends Model
{
    use HasFactory;
    use Sluggable;
    const PAGINATION_COUNT = 5;
    protected static $unguarded = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    protected static function booted()
//    {
//      static::creating(function (Idea $idea) {
//          $idea->slug = Str::slug($idea->title);
//      });
//    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

//    public function getStatusClass()
//    {
//        switch ($this->status->name){
//            case 'Close':
//                return 'bg-red text-white';
//            case 'Considering':
//                return 'bg-purple text-white';
//            case 'In Progress':
//                return 'bg-yellow text-white';
//            case 'Implemented':
//                return 'bg-green text-white';
//            default:
//                return 'bg-gray-300';
//        }
//    }

    public function votedUsers()
    {
        return $this->belongsToMany(User::class, 'votes',  'idea_id', 'user_id')->withTimestamps();
    }

    public function isVotedByUser(?int $userId):bool
    {
        if (!$userId) {
            return false;
        }
        return $this->votedUsers()->where('users.id',$userId)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
