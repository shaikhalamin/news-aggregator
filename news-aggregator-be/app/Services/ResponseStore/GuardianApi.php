<?php

namespace App\Services\ResponseStore;

use App\Factories\Interfaces\NewsResponseStoreInterface;
use App\Services\Aggregator\AggregatorType;
use App\Services\UserFeed\UserFeedService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class GuardianApi implements NewsResponseStoreInterface
{

    public function __construct(private UserFeedService $userFeedService)
    {
    }

    public function store(int $userId, mixed $responseData, bool $isTopStories = false)
    {
        if (!empty($responseData) && !empty($responseData['response']['results'])) {

            foreach ($responseData['response']['results'] as $article) {

                $payload = [
                    'title' => $article['webTitle'],
                    'description' =>  null,
                    'content' => $article['fields']['bodyText'],
                    'content_html' => null,
                    'image_url' => $article['fields']['thumbnail'] ?? null,
                    'author' => $article['fields']['byline'] ?? null,
                    'news_url' => $article['webUrl'] ?? null,
                    'news_api_url' => $article['apiUrl'] ?? null,
                    'source' => AggregatorType::GURDIAN_API,
                    'is_topstories'=> $isTopStories,
                    'response_source' => AggregatorType::GURDIAN_API,
                    'category' => $article['sectionId'],
                    'published_at' => Carbon::parse($article['webPublicationDate'], 'UTC'),
                    'user_id' => $userId,
                ];

                $this->userFeedService->create($payload);
            }
        }

    }
}