<?php

namespace App\Services\Integracao\Contracts;

interface DataReader
{
    public function read(string $empresa): array;
}
