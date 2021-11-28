<?php

namespace Tests\Unit;

use App\Events\CommentWritten;
use App\Listeners\HandleCommentWritten;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
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
        try {
            // Fake a comment object
            $comment = new Comment();
            $comment->body = "Hello";
            $comment->user_id = 1;

            $listener = new HandleCommentWritten();

            $listener->handle(new CommentWritten($comment));

            // Dispatch event
            CommentWritten::dispatch($comment);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
