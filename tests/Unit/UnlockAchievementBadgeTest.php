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
     * Test that it can create user achievement for lessons watched.
     *
     * @return void
     */
    public function test_it_can_create_user_achievement_for_lesson_watched()
    {
        $user = User::find(5);
        $lessonWatchedCount = 1;

        $state = $this->createUserAchievement($user, $lessonWatchedCount, 'lessons_watched');

        $this->assertTrue($state);
    }

    /**
     * Test that it can create user achievement for comments written.
     *
     * @return void
     */
    public function test_it_can_create_user_achievement_for_comments_written()
    {
        $user = User::find(5);
        $commentCount = 1;

        $state = $this->createUserAchievement($user, $commentCount, 'comments_written');

        $this->assertTrue($state);
    }

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
