<?php
namespace EmailCampaign;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\EmailCampaignMail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use EmailCampaign\Console\Commands\MakeController;
class EmailCampaignService extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register migration publishing
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->commands([
            MakeController::class,
        ]);
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'emailcampaign');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/emailcampaign'),
        ], 'emailcampaign-views');
    }

    public function register()
    {
    $this->publishes([
        __DIR__.'/database/migrations' => database_path('migrations'),
    ], 'emailcampaign-migrations');
    $this->app->bind('EmailCampaign\Services\SendEmailCampaignService', function ($app) {
        return new \EmailCampaign\Services\SendEmailCampaignService();
    });
    }
}
