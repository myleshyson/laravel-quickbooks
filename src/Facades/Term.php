<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class Term extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'term';
    }
}
