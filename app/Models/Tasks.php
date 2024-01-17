<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "category",
        "priority",
        "description",
        "deadline",
        "user_id",
        "deadline"
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
