<?php

namespace App\Modules\Committees\Database\Seeders;

use App\Modules\Committees\Models\Committee;
use App\Modules\Membership\Models\Member;
use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    private const COMMITTEES = [
        ['name' => 'Finance Committee', 'description' => 'Oversees the budget, dues, and financial controls.'],
        ['name' => 'Membership Committee', 'description' => 'Reviews applications and manages member engagement.'],
        ['name' => 'Events Committee', 'description' => 'Plans and runs member events throughout the year.'],
        ['name' => 'Nominating Committee', 'description' => 'Recruits candidates for the board and officer positions.'],
    ];

    public function run(): void
    {
        if (Committee::count() > 0) {
            return;
        }

        $memberIds = Member::query()->pluck('id')->all();

        if (empty($memberIds)) {
            return;
        }

        foreach (self::COMMITTEES as $data) {
            $committee = Committee::create($data);

            $rosterSize = min(count($memberIds), random_int(5, 9));
            $picked = collect($memberIds)->shuffle()->take($rosterSize)->values();

            $attach = [];
            foreach ($picked as $index => $memberId) {
                $role = match ($index) {
                    0 => 'chair',
                    1 => 'vice-chair',
                    2 => 'secretary',
                    default => 'member',
                };

                $attach[$memberId] = [
                    'role' => $role,
                    'joined_at' => now()->subDays(random_int(30, 720))->toDateString(),
                ];
            }

            $committee->members()->attach($attach);
        }
    }
}
