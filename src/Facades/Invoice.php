<?php

namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Invoice extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'invoice';
    }
}
