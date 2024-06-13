<?php

namespace App\Services\SearchFilter;

class SearchFilterService
{
    public function getCategoriesBySource(string $source)
    {
        $sourceConfig = config('news_agrregator.sources' . '.' . $source);
        if (empty($sourceConfig) || empty($sourceConfig['categories'])) {
            return [];
        }

        return $sourceConfig['categories'];
    }
}
