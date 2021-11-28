<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;

class AchievementsController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        $achievements = $this->unlockedAchievements($user);
        $badge = $this->badge($user);

        return response()->json([
            'unlocked_achievements' => $achievements['unlockedAchievements'],
            'next_available_achievements' => $achievements['nextAchievements'],
            'current_badge' => $badge['currentBadge'],
            'next_badge' => $badge['nextBadge'],
            'remaing_to_unlock_next_badge' => $badge['remaining'],
        ]);
    }

    /**
     * Get users unlocked achievements.
     *
     * @param  User  $user
     * @return array|bool
     */
    public function unlockedAchievements(User $user)
    {
        try {
            $userAchievements = $user->achievements();

            // Unlocked Achievements
            $unlockedAchievements = $userAchievements->pluck('title')->toArray();

            $testArr = $userAchievements->get()->pluck('type', 'id')->toArray();
            $nextAchievements = [];

            // Find the next available achievements respectively
            foreach ($testArr as $key => $type) {
                $next = Achievement::find(Achievement::where([['id', '>', $key], ['type', '=', $type]])->min('id'))->title;
                $nextAchievements[] = $next;
            }
            return compact('unlockedAchievements', 'nextAchievements');
        } catch (\Throwable $th) {
            logger($th);
            return false;
        }
    }

    /**
     * Get user badges.
     *
     * @param  User  $user
     * @return array|bool
     */
    public function badge(User $user)
    {
        try {
            // Current badge
            $currentBadge = $user->badges()->orderBy('id')->first();
            $current = $currentBadge->title;

            // Next badge
            $nextBadge = Badge::find(Badge::where([['id', '>', $currentBadge->id]])->min('id'));
            $next = $nextBadge->title;

            // Remaining to unlock
            $remaining = ($nextBadge->achievement_count - $currentBadge->achievement_count);

            return compact('currentBadge', 'nextBadge', 'remaining');
        } catch (\Throwable $th) {
            logger($th);
            return false;
        }
    }
}
