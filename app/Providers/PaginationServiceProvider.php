<?php

namespace App\Providers;

use App\Presenters\PagiationPresenter;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //自定义分页模板
        Paginator::presenter(function (AbstractPaginator $paginator) {
            return new PagiationPresenter($paginator);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
