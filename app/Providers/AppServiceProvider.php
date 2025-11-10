<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            // Match: App\Domains\{Domain}\Models\{Model}
            // This is a custom Factory Resolver for resolving domain based data 
            if (preg_match('#^App\\\\Domains\\\\([^\\\\]+)\\\\Models\\\\(.+)$#', $modelName, $matches)) {
                $domain = $matches[1];
                $model  = $matches[2];
                return "App\\Domains\\{$domain}\\Database\\factories\\{$model}Factory";
            }

            // Fallback to Laravel's default (for App\Models\*, etc.)
            return Factory::resolveFactoryName($modelName);
        });
    }
}
