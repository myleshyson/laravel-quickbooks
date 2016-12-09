<?php
namespace Myleshyson\LaravelQuickBooks;

use Illuminate\Support\ServiceProvider;

class QuickBooksServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->publishes([__DIR__.'/config/QuickBooks.php' => config_path('quickbooks.php')]);
    }

    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Myleshyson\LaravelQuickBooks\QuickbooksController');
        $this->app->bind('connection', 'Myleshyson\LaravelQuickBooks\Services\Connection');
        $this->app->bind('account', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Account');
        $this->app->bind('bill', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Bill');
        $this->app->bind('billpayment', 'Myleshyson\LaravelQuickBooks\Services\Accounting\BillPayment');
        $this->app->bind('creditmemo', 'Myleshyson\LaravelQuickBooks\Services\Accounting\CreditMemo');
        $this->app->bind('estimate', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Estimate');
        $this->app->bind('item', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Item');
        $this->app->bind('invoice', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Invoice');
        $this->app->bind('journal_entry', 'Myleshyson\LaravelQuickBooks\Services\Accounting\JournalEntry');
        $this->app->bind('payment', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Payment');
        $this->app->bind('purchase', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Purchase');
        $this->app->bind('purchase_order', 'Myleshyson\LaravelQuickBooks\Services\Accounting\PurchaseOrder');
        $this->app->bind('refund_receipt', 'Myleshyson\LaravelQuickBooks\Services\Accounting\RefundReceipt');
        $this->app->bind('sales_receipt', 'Myleshyson\LaravelQuickBooks\Services\Accounting\SalesReceipt');
        $this->app->bind('time_activity', 'Myleshyson\LaravelQuickBooks\Services\Accounting\TimeActivity');
        $this->app->bind('vendor_credity', 'Myleshyson\LaravelQuickBooks\Services\Accounting\VendorCredit');
        $this->app->bind('payment_method', 'Myleshyson\LaravelQuickBooks\Services\Accounting\PaymentMethod');
        $this->app->bind('tax_code', 'Myleshyson\LaravelQuickBooks\Services\Accounting\TaxCode');
        $this->app->bind('tax_rate', 'Myleshyson\LaravelQuickBooks\Services\Accounting\TaxRate');
        $this->app->bind('term', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Term');
        $this->app->bind('vendor', 'Myleshyson\LaravelQuickBooks\Services\Accounting\Vendor');
    }
}
