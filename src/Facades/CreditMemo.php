<?php

namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class CreditMemo extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'creditmemo';
    }
}
