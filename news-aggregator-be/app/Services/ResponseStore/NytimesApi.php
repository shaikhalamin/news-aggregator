<?php

namespace App\Services\ResponseStore;

use App\Factories\Interfaces\NewsResponseStoreInterface;
use App\Services\Aggregator\AggregatorType;
use App\Services\UserFeed\UserFeedService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class NytimesApi implements NewsResponseStoreInterface
{

    public function __construct(private UserFeedService $userFeedService)
    {
    }

    public function store(int $userId, mixed $responseData, bool $isTopStories = false)
    {
        if (!empty($responseData) && !empty($responseData['response']['docs'])) {

            foreach ($responseData['response']['docs'] as $article) {
                $imageUrl = 'https://www.nytimes.com/' . $article['multimedia'][0]['url'];
                $payload = [
                    'title' => $article['headline']['main'],
                    'description' =>  null,
                    'content' => $article['lead_paragraph'] ?? null,
                    'content_html' => null,
                    'image_url' => $imageUrl,
                    'author' => $article['byline']['original'] ?? null,
                    'news_url' => $article['web_url'] ?? null,
                    'news_api_url' => null,
                    'source' => AggregatorType::NYTIMES_API,
                    'is_topstories' => $isTopStories,
                    'response_source' => AggregatorType::NYTIMES_API,
                    'category' =>  strtolower($article['section_name']),
                    'published_at' => Carbon::parse($article['pub_date'], 'UTC'),
                    'user_id' => $userId,
                ];

                $this->userFeedService->create($payload);
            }
        }
    }
}
