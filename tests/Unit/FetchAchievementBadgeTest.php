<?php

namespace Tests\Unit;

use App\Http\Controllers\AchievementsController;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class FetchAchievementBadgeTest extends TestCase
{
    public function setUp(): void
    {
        $this->achievementsController = new AchievementsController;
    }

    /**
     * Test that it can fetch user achievement.
     *
     * @return void
     */
    public function test_it_can_fetch_user_achievement()
    {
        $user = User::findOrFail(5);
        $data = $this->achievementsController->unlockedAchievements($user);
        // $this->assertTrue(true);
        dd($data);
    }
}
