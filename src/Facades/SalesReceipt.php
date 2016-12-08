<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class SalesReceipt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sales_receipt';
    }
}
