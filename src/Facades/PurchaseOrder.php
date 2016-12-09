<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class PurchaseOrder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'purchase_order';
    }
}
