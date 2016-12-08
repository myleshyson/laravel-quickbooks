<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class PurchaseOrder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'purchase_order';
    }
}
