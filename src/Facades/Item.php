<?php

namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Item extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'item';
    }
}
