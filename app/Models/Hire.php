<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_application_id',
        'employer_id',
        'freelancer_id',
        'hired_date',
        'progress_link',
        'hire_status',  // Add this field
    ];

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relationship with User (Freelancer)
    public function freelancer() {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    // Relationship with User (Employer)
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // Relationship with JobApplication
    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
