<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'package_id',
        'rating',
        'comment',
    ];

    /**
     * Get the user that wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the package that was reviewed.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
} 