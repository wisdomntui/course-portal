<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'achievement_count',
    ];

    /**
     * The users that own this badge.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements');
    }
}
