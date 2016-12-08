<?php

namespace Myleshy\Quickbooks\Services\Accounting;

use Myleshy\Quickbooks\Quickbooks;

class TaxRate extends Quickbooks
{
    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxRate WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxRate")[0];
    }
}
