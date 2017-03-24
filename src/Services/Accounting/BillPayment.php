<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Contracts\QBResourceContract;
use Myleshyson\LaravelQuickBooks\Quickbooks;

class BillPayment extends Quickbooks implements QBResourceContract
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_BillPayment();
        $this->resource = new \QuickBooks_IPP_Object_BillPayment();
        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_BillPayment();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->update($this->context, $this->realm, $id, $this->resource) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_BillPayment();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_BillPayment();
        $query = $this->service->query($this->context, $this->realm, "SELECT * FROM BillPayment WHERE Id = '$id' ");
        if (!empty($query)) {
            return $query[0];
        }
        return  'Looks like this id does not exist.';
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_BillPayment();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM BillPayment");
    }

    public function query($query)
    {
         $this->service = new \QuickBooks_IPP_Service_BillPayment();

         return $this->service->query($this->context, $this->realm, $query);
    }
}
