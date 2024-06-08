<?php

namespace App\Services\ResponseStore;

use App\Factories\Interfaces\NewsResponseStoreInterface;
use App\Services\Aggregator\AggregatorType;
use App\Services\UserFeed\UserFeedService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class NewsApiOrg implements NewsResponseStoreInterface
{

    public function __construct(private UserFeedService $userFeedService)
    {
    }

    public function store(int $userId, mixed $responseData, bool $isTopStories = false)
    {
        if (!empty($responseData) && $responseData->totalResults > 0) {
           
            foreach ($responseData->articles as $article) {
                $payload = [
                    'title' => $article->title,
                    'description' => $article->description ?? null,
                    'content' => $article->content ?? null,
                    'content_html' => null,
                    'image_url' => $article->urlToImage ?? null,
                    'author' => $article->author ?? null,
                    'news_url' => $article->url ?? null,
                    'news_api_url' => null,
                    'source' => AggregatorType::NEWS_API_ORG,
                    'is_topstories'=> $isTopStories,
                    'response_source' => $article->source ? $article->source->id : AggregatorType::NEWS_API_ORG,
                    'category' => null,
                    'published_at' => Carbon::parse($article->publishedAt, 'UTC'),
                    'user_id' => $userId,
                ];

                $this->userFeedService->create($payload);
            }
        }
    }
}
