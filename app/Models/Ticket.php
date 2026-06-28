<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'created_by',
        'assigned_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}