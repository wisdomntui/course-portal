<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $lessons = Lesson::factory()
        //     ->count(20)
        //     ->create();

        // Seed users table
        $user = User::factory()
            ->count(5)
            ->create();

        // Seed Achievements Table
        $achievements = [
            ['title' => 'First Lesson Watched', 'type' => 'lessons_watched', 'count_condition' => 1],
            ['title' => '5 Lessons Watched', 'type' => 'lessons_watched', 'count_condition' => 5],
            ['title' => '10 Lessons Watched', 'type' => 'lessons_watched', 'count_condition' => 10],
            ['title' => '25 Lessons Watched', 'type' => 'lessons_watched', 'count_condition' => 25],
            ['title' => '50 Lessons Watched', 'type' => 'lessons_watched', 'count_condition' => 50],
            ['title' => 'First Comment Written', 'type' => 'comments_written', 'count_condition' => 1],
            ['title' => '3 Comments Written', 'type' => 'comments_written', 'count_condition' => 3],
            ['title' => '5 Comments Written', 'type' => 'comments_written', 'count_condition' => 5],
            ['title' => '10 Comment Written', 'type' => 'comments_written', 'count_condition' => 10],
            ['title' => '20 Comment Written', 'type' => 'comments_written', 'count_condition' => 20],
        ];
        Achievement::insert($achievements);

        // Seed Badges Table
        $achievements = [
            ['title' => 'Beginner', 'achievement_count' => 0],
            ['title' => 'Intermediate', 'achievement_count' => 4],
            ['title' => 'Advanced', 'achievement_count' => 8],
            ['title' => 'Master', 'achievement_count' => 10],
        ];
        Badge::insert($achievements);
    }
}
