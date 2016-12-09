<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Connection extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'connection';
    }
}
