<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Quickbooks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'quickbooks';
    }
}
