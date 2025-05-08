<?php
namespace App;

class BinProvider implements BinProviderInterface
{
    private const BIN_LOOKUP_URL = 'https://lookup.binlist.net/';

    public function getCountryCode(string $bin): string
    {
        $response = file_get_contents(self::BIN_LOOKUP_URL . $bin);
        if (!$response) {
            throw new \Exception("Failed to fetch BIN info.");
        }

        $data = json_decode($response, true);
        return $data['country']['alpha2'] ?? 'UNKNOWN';
    }
}
