<?php

namespace App\Providers;

use App\Services\LineBotService;
use Illuminate\Support\ServiceProvider;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->lineBotRegister();
        $this->lineBotServiceRegister();
    }

    private function lineBotRegister()
    {
        $this->app->singleton(LINEBot::class, function () {
            $httpClient = new CurlHTTPClient(config('linebot_token'));
            return new LINEBot($httpClient, ['channelSecret' => config('linebot_secret')]);
        });
    }
    private function lineBotServiceRegister()
    {
        $this->app->singleton(LineBotService::class, function () {
            return new LineBotService(config('app.line_user_id'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
