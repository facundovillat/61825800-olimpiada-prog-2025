<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'bio',
        'avatar',
        'address',
        'latitude',
        'longitude',
        'skills',
        'rating',
        'completed_jobs',
        'is_verified'
    ];

    protected $casts = [
        'skills' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'rating' => 'decimal:2',
        'is_verified' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 