<?php
namespace Myleshy\Quickbooks\Facades;

use Illuminate\Support\Facades\Facade;

class Connection extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'connection';
    }
}
