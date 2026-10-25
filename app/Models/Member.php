<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'member_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'joined_at',
        'expires_at',
    ];

    protected $casts = [
        'joined_at' => 'date',
        'expires_at' => 'date',
    ];
}
