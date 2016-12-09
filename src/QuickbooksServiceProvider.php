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
        $this->app->make('Myleshy\Quickbooks\QuickbooksController');
        $this->app->bind('account', 'Myleshy\Quickbooks\Services\Accounting\Account');
        $this->app->bind('quickbooks', 'Myleshy\Quickbooks\Accounting\Quickbooks');
        $this->app->bind('bill', 'Myleshy\Quickbooks\Services\Accounting\Bill');
        $this->app->bind('billpayment', 'Myleshy\Quickbooks\Services\Accounting\BillPayment');
        $this->app->bind('creditmemo', 'Myleshy\Quickbooks\Services\Accounting\CreditMemo');
        $this->app->bind('estimate', 'Myleshy\Quickbooks\Services\Accounting\Estimate');
        $this->app->bind('item', 'Myleshy\Quickbooks\Services\Accounting\Item');
        $this->app->bind('invoice', 'Myleshy\Quickbooks\Services\Accounting\Invoice');
        $this->app->bind('journal_entry', 'Myleshy\Quickbooks\Services\Accounting\JournalEntry');
        $this->app->bind('payment', 'Myleshy\Quickbooks\Services\Accounting\Payment');
        $this->app->bind('purchase', 'Myleshy\Quickbooks\Services\Accounting\Purchase');
        $this->app->bind('purchase_order', 'Myleshy\Quickbooks\Services\Accounting\PurchaseOrder');
        $this->app->bind('refund_receipt', 'Myleshy\Quickbooks\Services\Accounting\RefundReceipt');
        $this->app->bind('sales_receipt', 'Myleshy\Quickbooks\Services\Accounting\SalesReceipt');
        $this->app->bind('time_activity', 'Myleshy\Quickbooks\Services\Accounting\TimeActivity');
        $this->app->bind('vendor_credity', 'Myleshy\Quickbooks\Services\Accounting\VendorCredit');
        $this->app->bind('payment_method', 'Myleshy\Quickbooks\Services\Accounting\PaymentMethod');
        $this->app->bind('tax_code', 'Myleshy\Quickbooks\Services\Accounting\TaxCode');
        $this->app->bind('tax_rate', 'Myleshy\Quickbooks\Services\Accounting\TaxRate');
        $this->app->bind('term', 'Myleshy\Quickbooks\Services\Accounting\Term');
        $this->app->bind('vendor', 'Myleshy\Quickbooks\Services\Accounting\Vendor');
    }
}
