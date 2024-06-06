<?php

namespace App\Services\Aggregator;

use jcobhams\NewsApi\NewsApi;

class NewsApiOrg
{

    private $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi('4ec3d88439444a87b62b0adf53981e58');
    }


    public function getEverything($params = [])
    {
        $q = $params['q'] ?? null;
        $sources = $params['sources'] ?? null;
        $domains  = $params['domains'] ?? null;
        $exclude_domains =  $params['exclude_domains'] ?? null;
        $from = $params['from'] ?? null;
        $to = $params['to'] ?? null;
        $language = $params['language'] ?? null;
        $sort_by = $params['sort_by'] ?? null;
        $page_size = $params['page_size'] ?? null;
        $page = $params['page'] ?? null;
        $all_articles = $this->newsApi
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
    }

    public function getTopHeadlines($params = [])
    {

        $q = $params['q'] ?? null;
        $sources = $params['sources'] ?? null;
        $country = $params['country'] ?? null;
        $category = $params['category'] ?? null;
        $page_size = $params['page_size'] ?? null;
        $page = $params['page'] ?? null;
        $top_headlines = $this->newsApi
            ->getTopHeadlines(
                $q,
                $sources,
                $country,
                $category,
                $page_size,
                $page
            );
    }

    public function getSources($params = [])
    {
        $category = $params['category'] ?? null;
        $language = $params['language'] ?? null;
        $country = $params['country'] ?? null;
        $sources = $this->newsApi->getSources($category, $language, $country);
    }
}
