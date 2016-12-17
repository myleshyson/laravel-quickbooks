<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class Purchase extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        $this->resource = new \QuickBooks_IPP_Object_Purchase();
        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->update($this->context, $this->realm, $id, $this->resource) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        return parent::_delete($this->context, $this->realm, QuickBooks_IPP_IDS::RESOURCE_PURCHASE, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase");
    }
}
