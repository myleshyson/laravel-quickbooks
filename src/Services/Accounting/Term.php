<?php

namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class Term extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Term();
        $this->resource = new \QuickBooks_IPP_Object_Term();
        $this->handleNameListData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Term();
        $this->resource = $this->find($id);

        $this->handleNameListnData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_TERM, $this->resource, $id);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Term();
        return parent::_delete($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_TERM, $id);
    }

    public function find($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Term();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Term WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_IPP_Service_Term();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Term");
    }
}
