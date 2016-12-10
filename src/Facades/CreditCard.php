<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class CreditCard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'credit_card';
    }
}
