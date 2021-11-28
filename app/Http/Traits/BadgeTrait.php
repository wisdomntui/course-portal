<?php

namespace App\Http\Traits;

use App\Models\Badge;
use App\Models\UserAchievement;

trait BadgeTrait
{
    /**
     * Create user badge.
     *
     * @param  integer $userId
     * @return void
     */
    public function createBadge($userId)
    {
        // Get number of achievements
        $achievementCount = UserAchievement::where('user_id', $userId)->count();

        // Determine user achievement
        switch ($achievementCount) {
            case 0:
                $this->storeBadge($userId, $achievementCount);
                break;
            case 4:
                $this->storeBadge($userId, $achievementCount);
                break;
            case 8:
                $this->storeBadge($userId, $achievementCount);
                break;
            case 10:
                $this->storeBadge($userId, $achievementCount);
                break;
        }
    }

    /**
     * Insert data.
     *
     * @param  integer $userId
     * @param  integer $achievementCount
     * @return void
     */
    private function storeBadge($userId, $achievementCount)
    {
        $badge = Badge::firstWhere('achievement_count', $achievementCount);

        // Insert data
        $badge->users()->sync([$userId]);
    }

}
