<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class BankAccount extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bank_account';
    }
}
