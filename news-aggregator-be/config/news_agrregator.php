<?php

use App\Services\Aggregator\AggregatorType;

return [
    'sources' => [
        AggregatorType::NEWS_API_ORG => [
            'base_uri' => 'https://newsapi.org/v2',
            'all' => 'everything',
            'headlines' => 'top-headlines',
            'fetch_headline' => true,
            'categories' => [
                "business",
                "entertainment",
                "general",
                "health",
                "science",
                "sports",
                "technology"
            ],
            'news_sources' => ['bbc-news', 'al-jazeera-english', 'cnn', 'fox-news'],
            'api_key' => env('NEWSAPI_ORG_API_KEY')
        ],
        AggregatorType::GURDIAN_API => [
            'base_uri' => 'http://content.guardianapis.com',
            'all' => 'search',
            'headlines' => 'search',
            'fetch_headline' => false,
            'news_sources' => [AggregatorType::GURDIAN_API],
            'api_key' => env('GURDIAN_API_KEY')
        ],
        AggregatorType::NYTIMES_API => [
            'base_uri' => 'https://api.nytimes.com/svc',
            'all' => 'search/v2/articlesearch.json',
            'headlines' => 'topstories/v2',
            'fetch_headline' => true,
            'categories' => [
                "arts",
                "automobiles",
                "business",
                "fashion",
                "food",
                "health",
                "home",
                "insider",
                "magazine",
                "movies",
                "nyregion",
                "obituaries",
                "opinion",
                "politics",
                "realestate",
                "science",
                "sports",
                "sundayreview",
                "technology",
                "theater",
                "travel",
                "upshot",
                "us",
                "world",
                "books/review",
                "t-magazine",
            ],
            'news_sources' => [AggregatorType::NYTIMES_API],
            'api_key' => env('NYTIMES_API_KEY')
        ]
    ]



];