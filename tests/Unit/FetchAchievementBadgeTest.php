<?php

namespace Tests\Unit;

use App\Http\Controllers\AchievementsController;
use App\Models\User;
use Tests\TestCase;

class FetchAchievementBadgeTest extends TestCase
{

    /**
     * Test that it can fetch user achievement data.
     *
     * @return void
     */
    public function test_it_can_fetch_user_achievement_data()
    {
        $user = User::findOrFail(5);
        $data = (new AchievementsController)->unlockedAchievements($user);
        $this->assertIsArray($data);
    }

    /**
     * Test that it can fetch user badge data.
     *
     * @return void
     */
    public function test_it_can_fetch_user_badge_data()
    {
        $user = User::findOrFail(5);
        $data = (new AchievementsController)->badge($user);
        $this->assertIsArray($data);
    }
}
