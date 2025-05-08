<?php
use PHPUnit\Framework\TestCase;
use App\CommissionCalculator;
use App\BinProviderInterface;
use App\ExchangeRateProviderInterface;

class CommissionCalculatorTest extends TestCase
{
    public function testCommissionCalculationForEu()
    {
        $binMock = $this->createMock(BinProviderInterface::class);
        $rateMock = $this->createMock(ExchangeRateProviderInterface::class);

        $binMock->method('getCountryCode')->willReturn('DE');
        $rateMock->method('getRate')->willReturn(1.2);

        $calc = new CommissionCalculator($binMock, $rateMock);
        $result = $calc->calculate('45717360', 120.00, 'USD');

        $this->assertEquals(1.00, $result);
    }

    public function testCommissionCalculationForNonEu()
    {
        $binMock = $this->createMock(BinProviderInterface::class);
        $rateMock = $this->createMock(ExchangeRateProviderInterface::class);

        $binMock->method('getCountryCode')->willReturn('US');
        $rateMock->method('getRate')->willReturn(2.0);

        $calc = new CommissionCalculator($binMock, $rateMock);
        $result = $calc->calculate('516793', 100.00, 'USD');

        $this->assertEquals(1.00, $result);
    }

    public function testCommissionCeiling()
    {
        $binMock = $this->createMock(BinProviderInterface::class);
        $rateMock = $this->createMock(ExchangeRateProviderInterface::class);

        $binMock->method('getCountryCode')->willReturn('US');
        $rateMock->method('getRate')->willReturn(1.0);

        $calc = new CommissionCalculator($binMock, $rateMock);
        $result = $calc->calculate('41417360', 130.00, 'USD');

        $this->assertEquals(2.60, $result);
    }
}
