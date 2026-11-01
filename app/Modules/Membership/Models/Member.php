<?php

namespace App\Modules\Membership\Models;

use App\Modules\Committees\Models\Committee;
use App\Modules\Membership\Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    /** @use HasFactory<MemberFactory> */
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

    public function committees(): BelongsToMany
    {
        return $this->belongsToMany(Committee::class, 'committee_member')
            ->withPivot(['role', 'joined_at'])
            ->withTimestamps();
    }

    protected static function newFactory(): Factory
    {
        return MemberFactory::new();
    }
}
