<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
