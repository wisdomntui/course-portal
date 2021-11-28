<?php

namespace App\Http\Traits;

use App\Events\BadgeUnlocked;
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
    public function createBadge($user)
    {
        // Get number of achievements
        $achievementCount = UserAchievement::where('user_id', $user->id)->count();

        // Determine user achievement
        switch ($achievementCount) {
            case 0:
                $this->storeBadge($user, $achievementCount);
                break;
            case 4:
                $this->storeBadge($user, $achievementCount);
                break;
            case 8:
                $this->storeBadge($user, $achievementCount);
                break;
            case 10:
                $this->storeBadge($user, $achievementCount);
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
    private function storeBadge($user, $achievementCount)
    {
        $badge = Badge::firstWhere('achievement_count', $achievementCount);

        // Insert data
        $badge->users()->sync([$user->id]);

        // Fire badge unlock event
        BadgeUnlocked::dispatch($badge->title, $user);
    }

}
