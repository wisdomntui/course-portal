<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'count_condition',
    ];

    /**
     * The users that own this achievement.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements');
    }
}
