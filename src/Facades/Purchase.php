<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Purchase extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'purchase';
    }
}
