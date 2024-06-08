<?php

namespace App\Services\Aggregator;

use App\Factories\Interfaces\NewsApiInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Throwable;

class GuardianApi implements NewsApiInterface
{
    private $sourceConfig;

    public function __construct()
    {
        $this->sourceConfig = config('news_agrregator.sources' . '.' . AggregatorType::GURDIAN_API);
    }

    public function all($params = [])
    {
        Log::info('[GuardianApi]: all api call started  ===> : ');
        try {
            $httpQuery = [
                'page' => 1,
                'page-size' => 200,
                'show-fields' => 'body,thumbnail,byline,publication,shortUrl,lastModified',
                'api-key' => $this->sourceConfig['api_key'],
                // 'from-date' => '2024-06-04',
                // 'to-date' => '2024-06-08',
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

            Log::error('[GuardianApi]: all api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }


    public function headlines($params = [])
    {
        Log::info('[GuardianApi]: call started  ===> : ');
        try {
            $httpQuery = [
                'page' => 1,
                'page-size' => 200,
                'show-fields' => 'body,thumbnail,byline,publication,shortUrl,lastModified',
                'api-key' => $this->sourceConfig['api_key'],
                'from-date' => '2024-06-04',
                'to-date' => '2024-06-08',
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
            Log::error('[GuardianApi]: headlines api call error  ===> : ' . $th->getMessage());
            return [];
        }
    }
}
