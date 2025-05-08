#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\BinProvider;
use App\ExchangeRateProvider;
use App\CommissionCalculator;

$filename = $argv[1] ?? null;
if (!$filename || !file_exists($filename)) {
    fwrite(STDERR, "Input file missing or invalid.\n");
    exit(1);
}

$calculator = new CommissionCalculator(
    new BinProvider(),
    new ExchangeRateProvider()
);

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!isset($data['bin'], $data['amount'], $data['currency'])) {
        continue;
    }

    $commission = $calculator->calculate($data['bin'], (float)$data['amount'], $data['currency']);
    echo number_format($commission, 2, '.', '') . PHP_EOL;
}
