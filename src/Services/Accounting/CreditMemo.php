<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class CreditMemo extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_CreditMemo();
        $this->resource = new \QuickBooks_IPP_Object_CreditMemo();
        $this->handleTransactionData($data, $this->CreditMemo);
        $this->createLines($data['Lines'], $this->CreditMemo);

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_CreditMemo();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->update($this->context, $this->realm, $id, $this->resource) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_CreditMemo();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_CreditMemo();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM CreditMemo WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_CreditMemo();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM CreditMemo");
    }
}
