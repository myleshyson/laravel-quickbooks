<?php

namespace Myleshyson\LaravelQuickBooks\Contracts;

interface QBResourceContract
{

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function find($id);

    public function get();
}
