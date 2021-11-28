<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Http\Traits\BadgeTrait;
use App\Models\Achievement;
use App\Models\User;

class HandleLessonWatched
{
    use BadgeTrait;

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
        $lesson = $event->lesson;

        // Get number of lessons watched
        $user = User::find($userId);
        $lessonWatchedCount = $user->lessons()->count();

        // Determine user achievement
        switch ($lessonWatchedCount) {
            case 5:
                $this->createUserAchievement($user, $lessonWatchedCount);
                break;
            case 10:
                $this->createUserAchievement($user, $lessonWatchedCount);
                break;
            case 25:
                $this->createUserAchievement($user, $lessonWatchedCount);
                break;
            case 50:
                $this->createUserAchievement($user, $lessonWatchedCount);
                break;
        }

        // Create badge
        $this->createBadge($user);
    }

    /**
     * Create user comment achievement.
     *
     * @param  integer  $userId
     * @param  integer  $countCondition
     * @return void
     */
    private function createUserAchievement($user, $countCondition)
    {
        // Get achievement with that condition
        $achievement = Achievement::firstWhere([['count_condition', '=', $countCondition], ['type', '=', 'lessons_watched']]);

        // Insert data
        $achievement->users()->sync([$user->id]);

        // Dispatch achievement unlocked event
        AchievementUnlocked::dispatch($achievement->title, $user);
    }
}
