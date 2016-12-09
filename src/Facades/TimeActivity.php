<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class TimeActivity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'time_activity';
    }
}
