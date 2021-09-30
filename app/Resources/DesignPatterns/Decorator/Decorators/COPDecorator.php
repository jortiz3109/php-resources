<?php

namespace App\Resources\DesignPatterns\Decorator\Decorators;

class COPDecorator extends CurrencyDecorator
{
    protected function currency(): string
    {
        return 'COP';
    }
}
