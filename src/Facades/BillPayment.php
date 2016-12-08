<?php

namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class BillPayment extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'billpayment';
    }
}
