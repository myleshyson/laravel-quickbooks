<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentMethod extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment_method';
    }
}
