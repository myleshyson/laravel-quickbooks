<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class TaxRate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tax_rate';
    }
}
