<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Leave extends Model
{
    use HasFactory;

    // Change from number (1, 0) to (true, false)
    protected $casts = [
        'is_admin_seen' => 'boolean',
        'is_user_seen' => 'boolean',
        'start_date' => 'date:F j, Y',
        'end_date' => 'date:F j, Y',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('F j, Y H:i:s A');
    }
}
