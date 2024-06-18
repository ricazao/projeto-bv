<?php

namespace App\Providers;

use App\Services\Integracao\Contracts\DataReader;
use App\Services\Integracao\DataReaders\FileDataReader;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DataReader::class, FileDataReader::class);
    }

    public function boot(): void
    {
        $this->setupCarbon();
        $this->loadHelpers();
    }

    private function setupCarbon(): void
    {
        Carbon::setLocale(config('app.locale'));
    }

    private function loadHelpers(): void
    {
        foreach (glob(app_path().'/Helpers/*.php') as $file) {
            require_once $file;
        }
    }
}
