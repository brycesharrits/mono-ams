<?php

namespace App\Modules\Membership\Database\Seeders;

use App\Modules\Membership\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        if (Member::count() > 0) {
            return;
        }

        Member::factory(50)->create();
    }
}
