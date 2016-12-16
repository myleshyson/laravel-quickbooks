<?php

namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class TaxRate extends Quickbooks
{
    public function find($id)
    {
        $this->service = new \QuickBooks_Ipp_Service_TaxRate();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxRate WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxRate")[0];
    }
}
