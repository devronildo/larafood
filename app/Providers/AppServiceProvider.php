<?php

namespace App\Providers;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use App\Models\Table;
use App\Observers\PlanObserver;
use App\Observers\CategoryObserver;
use App\Observers\TenantObserver;
use App\Observers\ProductObserver;
use App\Observers\ClientObserver;
use App\Observers\TableObserver;


use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
    }
}
