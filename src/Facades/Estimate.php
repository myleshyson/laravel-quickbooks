<?php

namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Estimate extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'estimate';
    }
}
