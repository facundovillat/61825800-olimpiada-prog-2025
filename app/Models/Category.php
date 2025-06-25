<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active' => 'boolean',
    ];

    /**
     * Get the jobs for the category.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
} 