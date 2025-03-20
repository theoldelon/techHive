<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review', 
        'rating', 
        'user_id', 
        'job_id', 
        'status'
    ];

    // Relationship with Job model
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relationship with User model (who wrote the review)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
