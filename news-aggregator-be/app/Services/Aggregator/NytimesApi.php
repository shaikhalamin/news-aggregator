<?php

namespace App\Services\Aggregator;

use App\Factories\Interfaces\NewsApiInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Throwable;

class NytimesApi implements NewsApiInterface
{
    private $sourceConfig;

    public function __construct()
    {
        $this->sourceConfig = config('news_agrregator.sources' . '.' . AggregatorType::NYTIMES_API);
    }

    public function all($params = [])
    {
        Log::info('Fetching [NytimesApi]: all api with data started ===> : ');
        try {
            $httpQuery = [
                'page' => 1,
                'api-key' => $this->sourceConfig['api_key'],
                // 'begin_date' => '2024-06-04',
                // 'end_date' => '2024-06-08',
                ...$params
            ];
            $allUrl = $this->sourceConfig['base_uri'] . '/' . $this->sourceConfig['all'];
            $response = Http::retry(3, 200)->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->get($allUrl, [...$httpQuery]);

            if ($response->successful()) {
                $data = $response->json();
                return $data;
            } else {
                return [];
            }
        } catch (Throwable $th) {

            Log::error('[NytimesApi]: all api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }

    public function headlines($params = [])
    {
        Log::info('Fetching [NytimesApi]: headlines api with data started ===> : ');
        try {
            $httpQuery = [
                'page' => 1,
                'api-key' => $this->sourceConfig['api_key'],
                // 'begin_date' => '2024-06-04',
                // 'end_date' => '2024-06-08',
                ...$params
            ];
            $allUrl = $this->sourceConfig['base_uri'] . '/' . $this->sourceConfig['headlines'];
            $response = Http::retry(3, 200)->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->get($allUrl, [...$httpQuery]);

            if ($response->successful()) {
                $data = $response->json();
                return $data;
            } else {
                return [];
            }
        } catch (Throwable $th) {

            Log::error('[NytimesApi]: headlines api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }
}