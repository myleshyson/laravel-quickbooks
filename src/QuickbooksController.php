<?php

namespace Myleshyson\LaravelQuickBooks;

use App\Http\Controllers\Controller;
use Myleshy\Quickbooks\Facades\Bill;
use Myleshy\Quickbooks\Facades\BillPayment;
use Myleshy\Quickbooks\Facades\CreditMemo;
use Myleshy\Quickbooks\Facades\Item;
use Myleshy\Quickbooks\Facades\Quickbooks;

class QuickbooksController extends Controller
{

    public function create()
    {
        dd(new \QuickBooks_IPP_Object_CashBack());
    }

    public function update()
    {
        dd(__DIR__);
        // dd(CreditMemo::update(162,
        //     [
        //     'CustomerRef' => 63,
        //     'DocNumber' => '1234',
        //     'PrivateNote' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur placeat, in ex quia atque dolor magni quidem harum labore voluptatibus nulla at illo dignissimos similique quis necessitatibus, impedit enim quam.',
        //     'Lines' => [
        //         'SalesItemLineDetail' => [
        //             'Description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur voluptatibus minus repellendus, culpa, suscipit id fuga quas rerum sit veniam amet nobis dignissimos quae porro laborum, sed, optio modi libero?',
        //             'Amount' => 2000,
        //             'ItemRef' => 7,
        //             'TaxCodeRef' => 4
        //         ],
        //         'DescriptionOnly' => [
        //             'LineNumber' => 1,
        //             'Amount' => 100,
        //             'Description' => 'buttplug',
        //             'ServiceDate' => date('Y-m-d')
        //         ],
        //     ],
        //     'TxnTaxDetail' => [
        //         'TxnTaxCodeRef' => 4,
        //         'Lines' => [
        //             'TaxLineDetail' => [
        //                 'Amount' => 200,
        //                 'TaxRateRef' => 13
        //             ]
        //         ]
        //     ]
        // ]));
    }

    public function get()
    {
        dd(Account::find(133));
    }

    public function find()
    {
    }

    public function connect()
    {
        Quickbooks::connect();
    }

    public function delete()
    {
        dd(Account::delete(133));
    }

    public function items()
    {
        dd(Item::get());
    }
}
