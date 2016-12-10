<?php

namespace Myleshyson\LaravelQuickBooks\Services\Payment;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class BankAccount extends Quickbooks
{
    public function charge(array $data)
    {
        $name = $data['name'];
        $number = $data['acct_number'];
        $routing = $data['routing'];
        $type = $data['type'];
        $phone = $data['phone'];
        $amount = $data['amount'];
        $currency = $data['currency'];

        switch ($type) {
            case 'checking':
                $type = \QuickBooks_Payments_BankAccount::TYPE_PERSONAL_CHECKING;
                break;
            case 'savings':
                $type = \QuickBooks_Payments_BankAccount::TYPE_PERSONAL_SAVINGS;
                break;
            default:
                $type = null;
                break;
        }

        $this->service = new \QuickBooks_Payments($this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['sandbox']);

        $this->asset = new \QuickBooks_Payments_BankAccount($name, $number, $routing, $type, $phone);

        if ($Transaction = $this->service->charge($this->context, $this->asset, $amount, $currency)) {
            print('Status: ' . $Transaction->getStatus() . '<br>');
        } else {
            print('Error while charging credit card: ' . $this->service->lastError());
        }
    }

    public function tokenize(array $data)
    {
        $name = $data['name'];
        $number = $data['acct_number'];
        $routing = $data['routing'];
        $type = \QuickBooks_Payments_BankAccount::TYPE_PERSONAL_CHECKING;
        $phone = $data['phone'];

        $amount = $data['amount'];
        $currency = $data['currency'];

        $this->service = new \QuickBooks_Payments($this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['sandbox']);

        $this->asset = new \QuickBooks_Payments_BankAccount($name, $number, $routing, $type, $phone);

        if ($Token = $this->service->tokenize($this->context, $this->asset)) {
            print_r($Token);
        } else {
            print('Error while tokenizing payment: ' . $this->service->lastResponse());
        }
    }
}
