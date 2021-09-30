<?php

namespace Tests\Unit\DesignPatterns;

use App\Resources\DesignPatterns\Decorator\Decorators\COPDecorator;
use App\Resources\DesignPatterns\Decorator\Decorators\CRCDecorator;
use App\Resources\DesignPatterns\Decorator\Decorators\USDDecorator;
use App\Resources\DesignPatterns\Decorator\Formatters\AmountFormatter;
use Tests\TestCase;

class DecoratorTest extends TestCase
{
    /**
     * @param string $decorator
     * @param string $expected
     * @dataProvider decoratorsProvider
     */
    public function testItCanFormatUsingDecorators(string $decorator, string $expected): void
    {
        $amountFormatter = new AmountFormatter();
        $decorator = new $decorator($amountFormatter);
        $this->assertEquals($expected, $decorator->format(20000));
    }

    public function decoratorsProvider(): array
    {
        return [
            'COP' => ['decorator' => COPDecorator::class, 'expected' => 'COP 20,000.00'],
            'USD' => ['decorator' => USDDecorator::class, '$20,000.00'],
            'CRC' => ['decorator' => CRCDecorator::class, 'CRC 20,000.00']
        ];
    }
}
