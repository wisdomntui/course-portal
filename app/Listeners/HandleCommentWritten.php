<?php

namespace App\Listeners;

use App\Http\Traits\BadgeTrait;
use App\Models\Achievement;
use App\Models\Comment;

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
            $userId = $event->comment->user_id;

            // Get number of comments
            $commentCount = Comment::where('user_id', $userId)->count();
            $commentCount = 1;
            // Determine user achievement
            switch ($commentCount) {
                case 1:
                    $this->createUserAchievement($userId, $commentCount);
                    break;
                case 3:
                    $this->createUserAchievement($userId, $commentCount);
                    break;
                case 5:
                    $this->createUserAchievement($userId, $commentCount);
                    break;
                case 10:
                    $this->createUserAchievement($userId, $commentCount);
                    break;
                case 20:
                    $this->createUserAchievement($userId, $commentCount);
                    break;
            }
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
    private function createUserAchievement($userId, $countCondition)
    {
        // Get achievement with that condition
        $achievement = Achievement::firstWhere([['count_condition', '=', $countCondition], ['type', '=', 'comments_written']]);

        // Insert data
        $achievement->users()->sync([$userId]);

        // Create badge
        $this->createBadge($userId);
    }
}
