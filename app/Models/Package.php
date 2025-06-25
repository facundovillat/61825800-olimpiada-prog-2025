<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

    protected $fillable = [
        'user_id', // The user who created the package (e.g., travel agency)
        'category_id',
        'title',
        'destination',
        'description',
        'duration', // e.g., in days
        'price',
        'includes_flights',
        'includes_hotel',
        'location', // Starting location
        'status',
    ];

    protected $casts = [
        'includes_flights' => 'boolean',
        'includes_hotel' => 'boolean',
    ];

    /**
     * Get the user that owns the package (agency).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the package belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the bookings for the travel package.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews for the package.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
} 