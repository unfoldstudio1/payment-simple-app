<?php
namespace App;

class ExchangeRateProvider implements ExchangeRateProviderInterface
{
    private const RATES_URL = 'https://api.exchangerate.host/latest?base=EUR';

    public function getRate(string $currency): float
    {
        $response = file_get_contents(self::RATES_URL);
        if (!$response) {
            throw new \Exception("Failed to fetch exchange rates.");
        }

        $data = json_decode($response, true);
        return $data['rates'][$currency] ?? 0.0;
    }
}
