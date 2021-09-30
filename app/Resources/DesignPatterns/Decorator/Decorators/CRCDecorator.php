<?php

namespace App\Resources\DesignPatterns\Decorator\Decorators;

class CRCDecorator extends CurrencyDecorator
{
    protected function currency(): string
    {
        return 'CRC';
    }
}
