# laravel-quickbooks
## A nice wrapper around the Quickbooks Online SDK.

###Installation
If you haven't already composer the quickbooks php sdk. If you're using php 7+ then you'll need to require the dev-master version.
```
composer require consolibyte/quickbooks
```
Then require this package.
```
composer require myleshyson/laravel-quickbooks
```
Add this line to you config/app.php.

```php
Myleshyson\LaravelQuickBooks\QuickBooksServiceProvider::class,
```

Finally on the command line publish the config file for the package like so.

```
php artisan vendor:publish --tag=quickbooks
```

These are the variables you need to set in your .env.

```


QB_DSN= e.g for mysql...mysqli:db-username:db-password@db-connection/db-name
QB_TOKEN=
QB_OAUTH_CONSUMER_KEY=
QB_OAUTH_CONSUMER_SECRET=

Make sure tese two url's are different.
QB_OAUTH_URL= url used to connect to quickbooks. 
QB_SUCCESS_URL= you are redirected to here when the handshake is successful. 

QB_SANDBOX=true

These two you shouldn't change unless you know what you're doing.
QB_USERNAME=DO_NOT_CHANGE_ME
QB_TENANT=12345
```
After that you should be set to go!

###Usage
This package was made for working with the QuickBooks Accounting API in mind. You can look at all of the accounting resources here under 'Transaction' and 'Name list' resources. [QuickBooks Accounting API](https://developer.intuit.com/docs/api/accounting)

####Note On Working With QuickBooks
Just because in the QuickBooks documentation something says optional doesn't mean that you don't need it for your request. If your request doesn't go through make sure to dd() to see what error QuickBooks is giving back. It may be asking you to set something that is optional.

There are a few resources that aren't supported by the QuickBooks SDK and those are listed here:

* CompanyCurrency
* Budget
* JournalCode
* TaxAgency
* TaxService
* Deposit
* Transfer


**Quick Note: Make sure when using this package you import the Facade class you want to use under Myleshyson\LaravelQuickBooks\Facades**

####Connecting To QuickBooks
Make sure the success url is differnt than the oauth (connection) url. Otherwise it will continually redirect you after a succsful 

```php
// routes/web.php
use Myleshyson\LaravelQuickBooks\Facades\Connection;

Route::get('/connect', function () {
  Connection::start();
});
```

If you want to disconnect from quickbooks then you can do it like so.
```php
// routes/web.php
use Myleshyson\LaravelQuickBooks\Facades\Connection;

Route::get('/', function () {
  Connection::stop();
});
```

####Making Requests

Every resource that's available has four methods except for TaxRate and TaxCode. Those only have a get and find method.

```php
Customer::create(array $data);

Customer::update($id, array $data);

Customer::delete($id);

Customer::find($id);

Customer::get(); //gets all customers associated with your account.
```

I used the same naming conventions as the QuickBooks API to make things easier. In order to create a resource like Customer for example, you would use it like this...

```php
// routes/web.php

use Myleshyson\LaravelQuickBooks\Facades\Customer;

Route::get('/', function () {
    Customer::create([
        'Taxable' => false,
        'BillAddr' => [
            'Line1' => '123 Test Street',
            'City' => 'Dallas',
            'State' => 'Texas',
            'CountrySubDivisionCode' => 'TX',
            'PostalCode' => '12345'
        ],
        'GivenName' => 'Bill',
        'FamilyName' => 'Something',
        'FullyQualifiedName' => "Bill's Surf Shop"
    ]);
});
```

To handle any type of line in QuickBooks handle it like so. The key in the Lines array is the DetailType of the line. Check the documentation for what attributes you can set for the specific line you want.

Here are the different line types in quickbooks:

* SalesItemLineDetail
* ItemBasedExpenseLineDetail
* AccountBasedExpenseLineDetail
* GroupLineDetail
* DescriptionOnly
* DiscountLineDetail
* SubtotalLine
* TaxLineDetail

```php
use Myleshyson\LaravelQuickBooks\Facades\Invoice;

Invoice::create([
  'CustomerRef' => 1,
  'Lines' => [
    'SalesItemLineDetail' => [
      'ItemRef' => 1,
      'Amount' => 20,
      'MarkupInfo' => [
        'PercentBased' => true
      ]
    ],
    'GroupLineDetail' => [
      '...etc'
    ]
  ],
  'TxnTaxDetail' => [
    'TxnTaxCodeRef' => 8,
    'Lines' => [
      'TaxLineDetail' => [
        'SomeStuff'
      ],
      'TaxLineDetail' => [
        'MoreStuff'
      ]
    ]
  ]
]);
```
