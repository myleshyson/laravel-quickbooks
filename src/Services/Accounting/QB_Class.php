<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class QB_Class extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Class();
        $this->resource = new \QuickBooks_IPP_Object_Class();
        $this->handleTransactionData($data, $this->resource);
        $this->createLines(isset($data['Lines']), $this->resource);

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Class();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        $this->createLines(isset($data['Lines']), $this->resource);
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_CLASS, $this->employee, $id);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Class();
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_Class, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Class();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Class WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Class();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Class");
    }
}
