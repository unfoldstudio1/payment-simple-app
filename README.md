# Commission Fee Calculator

This is a clean, testable, and extensible PHP application to calculate commission fees for card transactions.

## ✅ Features

- Supports EU and non-EU commission rules
- Converts all currencies to EUR using a live exchange rate
- Mockable external services for BIN and exchange rate
- Commission fee is rounded **up** to nearest cent

## 🧪 Running Tests

Install dependencies and run tests:

```bash
composer install
./vendor/bin/phpunit tests/CommisionCalculatorTest.php
```

## 🚀 Running the App

Provide a file with transactions, one per line in JSON:

```json
{"bin":"45717360","amount":"100.00","currency":"EUR"}
```

Run the app:

```bash
php bin/app.php input.txt
```

Each output line corresponds to commission fee for that transaction.
