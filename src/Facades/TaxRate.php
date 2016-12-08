<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class TaxRate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tax_rate';
    }
}
