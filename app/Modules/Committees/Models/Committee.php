<?php

namespace App\Modules\Committees\Models;

use App\Modules\Committees\Database\Factories\CommitteeFactory;
use App\Modules\Membership\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Committee extends Model
{
    /** @use HasFactory<CommitteeFactory> */
    use HasFactory;

    public const ROLES = ['chair', 'vice-chair', 'secretary', 'member'];

    protected $fillable = [
        'name',
        'description',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'committee_member')
            ->withPivot(['role', 'joined_at'])
            ->withTimestamps()
            ->orderByPivot('role')
            ->orderBy('last_name')
            ->orderBy('first_name');
    }

    protected static function newFactory(): Factory
    {
        return CommitteeFactory::new();
    }
}
