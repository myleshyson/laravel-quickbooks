<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Bill extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bill';
    }
}
