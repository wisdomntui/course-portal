<?php

namespace Tests\Unit;

use App\Events\LessonWatched;
use App\Listeners\HandleLessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Tests\TestCase;

class UnlockAchievementBadgeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * Test .
     *
     * @return void
     */
    public function test_it_can_create_comment_achievement_and_badge()
    {
        // Fake a lesson object
        // $comment = new Comment();
        // $comment->body = "Hello";
        // $comment->user_id = 5;

        $user = User::find(5);
        $lesson = Lesson::find(20);

        $listener = new HandleLessonWatched();

        $listener->handle(new LessonWatched($lesson, $user));

        // Dispatch event
        // CommentWritten::dispatch($comment);
    }
}
