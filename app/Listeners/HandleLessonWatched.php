<?php

namespace App\Listeners;

use App\Http\Traits\AchievementTrait;
use App\Http\Traits\BadgeTrait;
use App\Models\User;

class HandleLessonWatched
{
    use BadgeTrait, AchievementTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $userId = $event->user->id;

        // Get number of lessons watched
        $user = User::findOrFail($userId);
        $lessonWatchedCount = $user->lessons()->count();

        // Determine user achievement
        switch ($lessonWatchedCount) {
            case 5:
                $this->createUserAchievement($user, $lessonWatchedCount, 'lessons_watched');
                break;
            case 10:
                $this->createUserAchievement($user, $lessonWatchedCount, 'lessons_watched');
                break;
            case 25:
                $this->createUserAchievement($user, $lessonWatchedCount, 'lessons_watched');
                break;
            case 50:
                $this->createUserAchievement($user, $lessonWatchedCount, 'lessons_watched');
                break;
        }

        // Create badge
        $this->createBadge($user);
    }
}
