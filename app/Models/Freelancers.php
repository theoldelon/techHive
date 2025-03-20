<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancers extends Model
{
    use HasFactory;

    protected $table = 'freelancers';

    protected $fillable = [
        'user_id', 
        'valid_id', 
        'selfie_with_id', 
        'diploma', 
        'certificate', 
        'resume', 
        'profile_picture',
    ];    

    // Define the relationship with the User model
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}