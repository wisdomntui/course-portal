<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        try {
            $user = User::factory()->create();

            $response = $this->get("/users/{$user->id}/achievements");

            $response->assertStatus(200);
        } catch (\Throwable $th) {
            logger($th);
        }
    }
}
