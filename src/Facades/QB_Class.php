<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class QB_Class extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'class';
    }
}
