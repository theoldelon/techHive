<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_title',
        'amount_payable',
        'reference_id',
        'bank_name',
        'payment_method',
        'proof',
    ];

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relationship with User (Employer)
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // In UserRequest model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // In the UserRequest model
    protected $casts = [
        'payment_method' => 'integer',
    ];

}
