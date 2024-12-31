<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendenceDeatail extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add the 'bonuses' column to the fillable property
    protected $fillable = [
        'user_id',
        'total_salary',
        'bonuses', // Allow mass assignment for this column
    ];

    // Optionally, specify the $casts property if 'bonuses' is JSON
    protected $casts = [
        'bonuses' => 'array', // Cast bonuses to array if stored as JSON
    ];


    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
