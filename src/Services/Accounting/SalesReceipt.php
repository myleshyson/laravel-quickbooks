<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class SalesReceipt extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_SalesReceipt();
        $this->resource = new \QuickBooks_IPP_Object_SalesReceipt();
        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_SalesReceipt();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';
        return $this->service->update($this->context, $this->realm, $id, $this->resource);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_SalesReceipt();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_SalesReceipt();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM SalesReceipt WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_SalesReceipt();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM SalesReceipt");
    }
}
