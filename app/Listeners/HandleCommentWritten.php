<?php

namespace App\Listeners;

use App\Http\Traits\AchievementTrait;
use App\Http\Traits\BadgeTrait;
use App\Models\Comment;
use App\Models\User;

class HandleCommentWritten
{
    use BadgeTrait, AchievementTrait;

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
        $user = User::findOrFail($event->comment->user_id);

        // Get number of comments
        $commentCount = Comment::where('user_id', $user->id)->count();

        // Determine user achievement
        switch ($commentCount) {
            case 1:
                $this->createUserAchievement($user, $commentCount, 'comments_written');
                break;
            case 3:
                $this->createUserAchievement($user, $commentCount, 'comments_written');
                break;
            case 5:
                $this->createUserAchievement($user, $commentCount, 'comments_written');
                break;
            case 10:
                $this->createUserAchievement($user, $commentCount, 'comments_written');
                break;
            case 20:
                $this->createUserAchievement($user, $commentCount, 'comments_written');
                break;
        }

        // Create badge
        $this->createBadge($user);
    }
}
