<?php
namespace App;

interface ExchangeRateProviderInterface
{
    public function getRate(string $currency): float;
}
