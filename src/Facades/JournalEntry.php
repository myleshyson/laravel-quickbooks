<?php
namespace Myleshyson\LaravelQuickBooks\Facades;

use Illuminate\Support\Facades\Facade;

class JournalEntry extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'journal_entry';
    }
}
