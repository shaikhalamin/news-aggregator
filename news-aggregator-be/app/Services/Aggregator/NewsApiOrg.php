<?php

namespace App\Services\Aggregator;

use App\Factories\Interfaces\NewsApiInterface;
use Illuminate\Support\Facades\Log;
use jcobhams\NewsApi\NewsApi;
use Throwable;

class NewsApiOrg implements NewsApiInterface
{

    public function __construct(private NewsApi $newsApi)
    {
    }

    public function all($params = [])
    {
        Log::info('Fetching [NewsApiOrg]: all api with data started ===> : ');
        try {

            $q = $params['q'] ?? null;
            $sources = $params['sources'];
            $domains  = $params['domains'] ?? null;
            $exclude_domains =  $params['exclude_domains'] ?? null;
            $from = $params['from'] ?? null;
            $to = $params['to'] ?? null;
            $language = $params['language'] ?? null;
            $sort_by = $params['sort_by'] ?? null;
            $page_size = $params['page_size'] ?? null;
            $page = $params['page'] ?? null;
            return $this->newsApi
                ->getEverything(
                    $q,
                    $sources,
                    $domains,
                    $exclude_domains,
                    $from,
                    $to,
                    $language,
                    $sort_by,
                    $page_size,
                    $page
                );
        } catch (Throwable $th) {

            Log::error('[GuardianApi]: all api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }

    public function headlines($params = [])
    {
        Log::info('Fetching [NewsApiOrg]: headlines api with data started ===> : ');
        try {
            $q = $params['q'] ?? null;
            $sources = $params['sources'];
            $country = $params['country'] ?? null;
            $category = $params['category'] ?? null;
            $page_size = $params['page_size'] ?? null;
            $page = $params['page'] ?? null;
            return $this->newsApi
                ->getTopHeadlines(
                    $q,
                    $sources,
                    $country,
                    $category,
                    $page_size,
                    $page
                );
        } catch (Throwable $th) {
            Log::error('[GuardianApi]: headlines api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }
}
