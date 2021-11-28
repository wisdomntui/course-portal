<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Http\Traits\BadgeTrait;
use App\Models\Achievement;
use App\Models\Comment;
use App\Models\User;

class HandleCommentWritten
{
    use BadgeTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $user = User::findOrFail($event->comment->user_id);

            // Get number of comments
            $commentCount = Comment::where('user_id', $user->id)->count();

            // Determine user achievement
            switch ($commentCount) {
                case 1:
                    $this->createUserAchievement($user, $commentCount);
                    break;
                case 3:
                    $this->createUserAchievement($user, $commentCount);
                    break;
                case 5:
                    $this->createUserAchievement($user, $commentCount);
                    break;
                case 10:
                    $this->createUserAchievement($user, $commentCount);
                    break;
                case 20:
                    $this->createUserAchievement($user, $commentCount);
                    break;
            }

            // Create badge
            $this->createBadge($user);
        } catch (\Throwable $th) {
            logger($th);
        }
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
        $achievement = Achievement::firstWhere([['count_condition', '=', $countCondition], ['type', '=', 'comments_written']]);

        // Insert data
        $achievement->users()->sync([$user->id]);

        // Dispatch achievement unlocked event
        AchievementUnlocked::dispatch($achievement->title, $user);
    }
}
