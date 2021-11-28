<?php

namespace App\Http\Traits;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;

trait AchievementTrait
{
    /**
     * Create user achievement.
     *
     * @param  integer  $userId
     * @param  integer  $countCondition
     * @param  integer  $achievementType
     * @return bool
     */
    private function createUserAchievement($user, $countCondition, $achievementType)
    {
        try {
            // Get achievement with that condition
            $achievement = Achievement::firstWhere([['count_condition', '=', $countCondition], ['type', '=', $achievementType]]);

            // Insert data
            $achievement->users()->sync([$user->id]);

            // Dispatch achievement unlocked event
            AchievementUnlocked::dispatch($achievement->title, $user);

            return true;
        } catch (\Throwable $th) {
            logger($th);
            return false;
        }
    }
}
