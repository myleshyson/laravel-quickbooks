<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class SalesReceipt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sales_receipt';
    }
}
