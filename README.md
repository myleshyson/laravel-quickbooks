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
QB_TOKEN=
QB_OAUTH_CONSUMER_KEY=
QB_OAUTH_CONSUMER_SECRET=
QB_OAUTH_URL=
QB_SUCCESS_URL=
QB_SANDBOX=true

//These two you don't need to change unless you need to for some reason.
QB_USERNAME=DO_NOT_CHANGE_ME
QB_TENANT=12345 
```
After that you should be set to go!

###Usage
This package was made for working with the QuickBooks Accounting API in mind. You can look at all of the accounting resources here under 'Transaction' and 'Name list' resources. [QuickBooks Accounting API](https://developer.intuit.com/docs/api/accounting)

There are a few resources that aren't supported by the QuickBooks SDK and those are listed here:
* CompanyCurrency
* Budget
* JournalCode
* TaxAgency
* TaxService
* Deposit
* Transfer

To connect to quickbooks.

```php
// web.php
use Myleshyson\LaravelQuickBooks\Facades\Customer;

Route::get('/', function () {
  Connection::start();
});
```

If you want to disconnect from quickbooks then you can do it like so.
```php
// web.php
use Myleshyson\LaravelQuickBooks\Facades\Customer;

Route::get('/', function () {
  Connection::stop();
});
```


I used the same naming conventions as the QuickBooks API to make things easier. In order to create a resource like Customer for example, you would use it like this...

```php
// web.php

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
*Make sure to import the Facade class* 

Most resources in the quickbooks api have lines that you can add to the object your building. For example an Invoice has line items and foreach line in the Invoice there could be sub line items and so forth. There are multiple lines types in quickbooks that are defined as the DetailType. For this package, set the DetailType as the key to the *Lines* multi-dimensional array and within it you can set both the Line data and the DetailType data. In order to create lines for the invoice it would look something like this.

```php
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
  ]
])
```

Every resource that's available has four methods:

```php
Customer::create(array $data);

Customer::update($id, array $data);

Customer::delete($id);

Customer::find($id);

Customer::get(); //gets all customers associated with your account.
```



