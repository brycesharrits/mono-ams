<?php

use App\Modules\Committees\CommitteesServiceProvider;
use App\Modules\Membership\MembershipServiceProvider;
use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    MembershipServiceProvider::class,
    CommitteesServiceProvider::class,
];
