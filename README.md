# laravel-quickbooks
## A nice wrapper around the Quickbooks Online SDK. 

This package is still in development. It's meant to give a nicer interaction with QuickBooks. For example. If you wanted to create a new customer, you would originally have to do something like this..

```php
$Customer = new QuickBooks_IPP_Object_Customer();
$CustomerService = new Quickbooks_IPP_Service_Customer();

$Customer->setGivenName('Billy');
$Customer->setMiddleName('J');
$Customer->setFamilyName('Joe');

$CustomerService->add($Context, $Realm, $Customer);
```

This package turns that into this...

```php
Customer::create([
  'GivenName' => 'Billy,
  'MiddleName' => 'J',
  'FamilyName' => 'Joe'
]);
```
