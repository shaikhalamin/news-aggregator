<?php

use App\Services\Command\UserFeedRefreshService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return ["success" => true, "message" => "News Aggregator Api Works", "data" => null];
});

Route::get('/refresh', function () {
    $refrsh = (new UserFeedRefreshService())->refresh();
    //dd(config('news_agrregator.sources'));
    return ["success" => true, "message" => "UserFeedRefreshService ", "data" => null];
});
