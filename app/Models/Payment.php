<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'hire_id',
        'employer_id',
        'freelancer_id',
        'send_to_name',
        'send_to_number',
        'job_salary',
        'service_fee',
        'amount_payable',
        'reference_id',
        'bank_name',
        'payment_method',
        'proof',
    ];

    public function hire() {
        return $this->belongsTo(Hire::class);
    }

    public function employer() {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function freelancer() {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}