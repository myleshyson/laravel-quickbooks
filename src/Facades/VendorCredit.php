<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class VendorCredit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vendor_credit';
    }
}
