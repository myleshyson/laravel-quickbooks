<?php

namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Purchase extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'purchase';
    }
}
