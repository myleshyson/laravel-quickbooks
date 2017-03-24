<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Contracts\QBResourceContract;
use Myleshyson\LaravelQuickBooks\Quickbooks;

class Purchase extends Quickbooks implements QBResourceContract
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
        $query = $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase WHERE Id = '$id' ");

        if (!empty($query)) {
            return $query[0];
        }
        return 'Looks like this id does not exist.';
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Purchase();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Purchase");
    }

    public function query($query)
    {
         $this->service = new \QuickBooks_IPP_Service_Purchase();

         return $this->service->query($this->context, $this->realm, $query);
    }
}
