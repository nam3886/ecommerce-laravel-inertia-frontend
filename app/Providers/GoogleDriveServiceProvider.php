<?php

namespace App\Providers;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend("google", function ($app, $config) {
            $refreshToken = config('settings.google_drive_refresh_token', env('GOOGLE_DRIVE_REFRESH_TOKEN'));
            $client = new \Google_Client;
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($refreshToken);
            // $client->refreshToken($config['refreshToken']);
            $service = new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);
            return new Filesystem($adapter);
        });
    }
}
