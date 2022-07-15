<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_id', 'cv', 'is_checking_by_admin', 'is_accepted'];
}
