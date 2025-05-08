<?php
namespace App;

class CommissionCalculator
{
    private $binProvider;
    private $rateProvider;

    public function __construct(BinProviderInterface $binProvider, ExchangeRateProviderInterface $rateProvider)
    {
        $this->binProvider = $binProvider;
        $this->rateProvider = $rateProvider;
    }

    public function calculate(string $bin, float $amount, string $currency): float
    {
        $countryCode = $this->binProvider->getCountryCode($bin);
        $isEu = CountryChecker::isEu($countryCode);
        $rate = $this->rateProvider->getRate($currency);

        $amountEur = $currency === 'EUR' || $rate == 0.0 ? $amount : $amount / $rate;
        $commission = $amountEur * ($isEu ? 0.01 : 0.02);

        return ceil($commission * 100) / 100;
    }
}
