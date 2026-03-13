<?php 
namespace App\Providers;

use App\Events\OrderPlaced;
use App\Listeners\ReduceProductStock;
use App\Listeners\SendOrderEmail;
use Illuminate\Support\Facades\Event; // Important!
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { /* ... */ }

    public function boot(): void
    {
        // Link the Event to multiple Listeners
        Event::listen(
            OrderPlaced::class,
            [ReduceProductStock::class, 'handle']
        );

        Event::listen(
            OrderPlaced::class,
            [SendOrderEmail::class, 'handle']
        );
    }
}