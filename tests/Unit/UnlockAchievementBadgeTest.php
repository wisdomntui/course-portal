<?php

namespace Tests\Unit;

use App\Http\Traits\AchievementTrait;
use App\Http\Traits\BadgeTrait;
use App\Models\User;
use Tests\TestCase;

class UnlockAchievementBadgeTest extends TestCase
{
    use BadgeTrait, AchievementTrait;

    /**
     * Test that it can create user badge.
     *
     * @return void
     */
    public function test_it_can_create_user_badge()
    {
        $user = User::find(5);

        $state = $this->createBadge($user);

        $this->assertTrue($state);
    }
}
