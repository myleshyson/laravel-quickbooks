<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Bill extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bill';
    }
}
