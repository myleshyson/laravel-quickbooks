<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Contracts\QBResourceContract;
use Myleshyson\LaravelQuickBooks\Quickbooks;

class Payment extends Quickbooks implements QBResourceContract
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Payment();
        $this->resource = new \QuickBooks_IPP_Object_Payment();
        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Payment();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->update($this->context, $this->realm, $id, $this->resource) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Payment();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Payment();
        $query = $this->service->query($this->context, $this->realm, "SELECT * FROM Payment WHERE Id = '$id' ")[0];
        if (isset($query)) {
            return $query;
        }
        return 'Looks like this id does not exist.';
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Payment();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Payment");
    }
}
