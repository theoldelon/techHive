<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'user_id', // Employer ID
        'job_type_id',
        'category_id',
        'salary',
        'vacancy',
        'company_name',
        'company_location',
        'company_website',
    ];

    // Relationship with JobType
    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with JobApplication
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Relationship with User (Employer)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Hires
    public function hires()
    {
        return $this->hasMany(Hire::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'job_id');
    }
}
