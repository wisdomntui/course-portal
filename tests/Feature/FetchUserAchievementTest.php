<?php

namespace Tests\Feature;

use Tests\TestCase;

class FetchUserAchievementTest extends TestCase
{
    /**
     * Test that it can fetch user achievements.
     *
     * @return void
     */
    public function test_it_can_fetch_user_achievements()
    {
        $response = $this->get('users/5/achievements');

        $response->assertStatus(200);
    }
}
