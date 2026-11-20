<?php

namespace SuperAdmin\Admin\ApiTester;

use Illuminate\Support\ServiceProvider;

class ApiTesterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Template-aware: <views>/<template>/ and <template>/extensions/api-tester/ override <views>/.
        if (class_exists(\SuperAdmin\Admin\Template\TemplateManager::class)) {
            \SuperAdmin\Admin\Facades\Admin::template()->extensionViews('api-tester', __DIR__.'/../resources/views');
        } else {
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'api-tester');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__.'/../resources/assets/' => public_path('vendor/api-tester')],
                'api-tester'
            );
        }

        ApiTester::boot();
    }
}
