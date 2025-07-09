<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase', function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));

            if (config('firebase.database_url')) {
                $factory = $factory->withDatabaseUri(config('firebase.database_url'));
            }

            return $factory->createDatabase();
        });

        $this->app->singleton('firebase.firestore', function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
            return $factory->createFirestore();
        });

        $this->app->singleton('firebase.auth', function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
            return $factory->createAuth();
        });
    }

    public function boot()
    {
        //
    }
}