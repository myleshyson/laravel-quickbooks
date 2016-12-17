<?php

namespace Myleshyson\LaravelQuickBooks\Services\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class TaxCode extends Quickbooks
{
    public function find($id)
    {
        $this->service = new \QuickBooks_Ipp_Service_TaxCode();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxCode WHERE Id = '$id' ")[0];
    }

    public function get()
    {
        $this->service = new \QuickBooks_Ipp_Service_TaxCode();
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxCode");
    }
}
