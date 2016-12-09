<?php
namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshy\Quickbooks\Quickbooks;

class Item extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Item();
        $this->resource = new \QuickBooks_IPP_Object_Item();
        $this->handleNameListData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
           
        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_Item();
        $this->resource = $this->find($id);

        $this->handleNameListData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return $this->service->update($this->context, $this->realm, $id, $this->resource);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_Item();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Item WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM Item")[0];
    }
}
