<?php

namespace App\Providers;

use App\Http\ViewComposers\LayoutsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class LayoutsServiceProvide extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'importDocs',
                'exportDocs',
                'package',
                'branc-chart',
                'branches',
                'category',
                'create_order',
                'index',
                'invoice',
                'itemwithserial',
                'retrive_order2',
                'header',
                'exports',
                'exportsOfDay'

            ],
            LayoutsComposer::class
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
