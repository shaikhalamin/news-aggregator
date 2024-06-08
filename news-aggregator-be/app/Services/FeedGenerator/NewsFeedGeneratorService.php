<?php

namespace App\Services\FeedGenerator;

use App\Jobs\StoreUserSourceNewsJob;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Log;
use Throwable;

class NewsFeedGeneratorService
{
    public function __construct(private UserService $userService)
    {
    }
    public function generateNewsFeed(int $userId)
    {
        try {
            $user  = $this->userService->show($userId, ['preferences']);
            Log::info('[FetchUserNewsFeedService]: first name  ===> : ' . $user->first_name);
            $userPreferences = $user->preferences;

            if (!empty($userPreferences)) {
                foreach ($userPreferences as $preference) {
                    Log::info('[FetchUserNewsFeedService]: dispatching source preference to store ===> : ' . $preference->source);
                    dispatch(new StoreUserSourceNewsJob($user->id, $preference));
                }
            }
        } catch (Throwable $th) {
            Log::info('[FetchUserNewsFeedService]: [error]:   ===> : ' . $th->getMessage());
        }
    }
}
