<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class RefundReceipt extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_RefundReceipt();
        $this->resource = new \QuickBooks_IPP_Object_RefundReceipt();
        $this->handleTransactionData($data, $this->resource);
        $this->createLines(isset($data['Lines']), $this->resource);

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_RefundReceipt();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        $this->createLines(isset($data['Lines']), $this->resource);
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_REFUNDRECEIPT, $this->resource, $id);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_RefundReceipt();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_RefundReceipt();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM RefundReceipt WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_RefundReceipt();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM RefundReceipt");
    }
}
