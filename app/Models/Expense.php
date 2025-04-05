<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';

    protected $fillable = [
        'amount',
        'category',
        'date',
        'description',
        'user_id',
        'is_recurring',
        'recurring_frequency',
    ];

    protected $casts = [
        'date' => 'date', // Cast the 'date' field to a date object
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
