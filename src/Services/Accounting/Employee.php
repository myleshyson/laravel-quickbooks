<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Contracts\QBResourceContract;
use Myleshyson\LaravelQuickBooks\Quickbooks;

class Employee extends Quickbooks implements QBResourceContract
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Employee();
        $this->resource = new \QuickBooks_IPP_Object_Employee();
        $this->handleNameListData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return $this->service->add($this->context, $this->realm, $this->resource) ?: $this->service->lastError();
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Employee();
        $this->resource = $this->find($id);

        $this->handleNameListData($data, $this->resource);
        isset($data['Lines']) ? $this->createLines($data['Lines'], $this->resource) : '';

        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_EMPLOYEE, $this->resource, $id) ?: $this->service->lastError();
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Employee();
        return parent::_delete($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_EMPLOYEE, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Employee();
        $query = $this->service->query($this->context, $this->realm, "SELECT * FROM Employee WHERE Id = '$id' ");
        if (!empty($query)) {
            return $query[0];
        }
        return 'Looks like this id does not exist.';
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Employee();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Employee");
    }
}
