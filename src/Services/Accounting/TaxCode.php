<?php

namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class TaxCode extends Quickbooks
{
    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxCode WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM TaxCode")[0];
    }
}
