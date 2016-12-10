<?php

namespace Myleshyson\LaravelQuickBooks\Services\Payment;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class CreditCard extends Quickbooks
{
    public function charge(array $data)
    {
        $number = $data['number'];
        $name = $data['name'];
        $expyear = $data['expyear'];
        $expmonth = $data['expmonth'];
        $street = $data['street'];
        $city = $data['city'];
        $region = $data['region'];
        $postalcode = $data['postal_code'];

        $amount = $data['amount'];
        $currency = $data['currency'];

        $this->service = new \QuickBooks_Payments($this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['sandbox']);

        $this->asset = new \QuickBooks_Payments_CreditCard($name, $number, $expyear, $expmonth, $street, $city, $region, $postalcode);

        if ($Transaction = $this->service->charge($this->context, $this->asset, $amount, $currency)) {
            print('Status: ' . $Transaction->getStatus() . '<br>');
        } else {
            print('Error while charging credit card: ' . $this->service->lastError());
        }
    }

    public function tokenize(array $data)
    {
        $number = $data['number'];
        $name = $data['name'];
        $expyear = $data['expyear'];
        $expmonth = $data['expmonth'];
        $street = $data['street'];
        $city = $data['city'];
        $region = $data['region'];
        $postalcode = $data['postal_code'];
        $this->service = new \QuickBooks_Payments($this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['sandbox']);

        $this->asset = new \QuickBooks_Payments_CreditCard($name, $number, $expyear, $expmonth, $street, $city, $region, $postalcode);

        if ($Token = $this->service->tokenize($this->context, $this->asset)) {
            print_r($Token);
        } else {
            print('Error while tokenizing payment: ' . $this->service->lastResponse());
        }
    }

    public function getCustomerCards($customerId)
    {
        $this->service = new \QuickBooks_Payments($this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['sandbox']);

        return $this->service->getCards($this->context, Customer::find($customerId));
    }
}
