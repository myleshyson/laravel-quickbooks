<?php

namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class VendorCredit extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_VendorCredit();
        $this->resource = new \QuickBooks_IPP_Object_VendorCredit();
        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_VendorCredit();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return $this->service->update($this->context, $this->realm, $id, $this->resource);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_VendorCredit();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM VendorCredit WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM VendorCredit")[0];
    }
}
