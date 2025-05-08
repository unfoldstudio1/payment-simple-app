<?php
namespace App;

interface BinProviderInterface
{
    public function getCountryCode(string $bin): string;
}
