<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'review', 
        'rating', 
        'user_id', 
        'freelancer_id', 
        'status'
    ];

    // Relationship with the user who wrote the review
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the freelancer being reviewed
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
