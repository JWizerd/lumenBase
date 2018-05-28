<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Store;
use App\Models\Tag;
use App\Models\Transaction;
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
        //
    }

    public function boot()
    {
        // This is where you register your observers. E.g.
        // Transaction::observe('App\Observers\TransactionObserver');
    }
}
