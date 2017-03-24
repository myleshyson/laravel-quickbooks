<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Contracts\QBResourceContract;
use Myleshyson\LaravelQuickBooks\Quickbooks;

class PaymentMethod extends Quickbooks implements QBResourceContract
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_PaymentMethod();
        $this->resource = new \QuickBooks_IPP_Object_PaymentMethod();
        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_PaymentMethod();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_PAYMENTMETHOD, $this->resource, $id) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_PaymentMethod();
        return parent::_delete($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_PAYMENTMETHOD, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_PaymentMethod();
        $query = $this->service->query($this->context, $this->realm, "SELECT * FROM PaymentMethod WHERE Id = '$id' ");
        if (!empty($query)) {
            return $query[0];
        }
        return 'Looks like this id does not exist.';
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_PaymentMethod();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM PaymentMethod");
    }

    public function query($query)
    {
         $this->service = new \QuickBooks_IPP_Service_PaymentMethod();

         return $this->service->query($this->context, $this->realm, $query);
    }
}
