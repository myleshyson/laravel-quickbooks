<?php

namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Invoice extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'invoice';
    }
}
