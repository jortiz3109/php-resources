<?php

namespace App\Resources\DesignPatterns\Decorator\Decorators;

class USDDecorator extends CurrencyDecorator
{
    protected function currency(): string
    {
        return 'USD';
    }
}
