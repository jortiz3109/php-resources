<?php

namespace App\Resources\DesignPatterns\Decorator\Formatters;

use App\Resources\DesignPatterns\Decorator\Contracts\AmountFormatterContract;

class AmountFormatter implements AmountFormatterContract
{
    public function format(int $price): string
    {
        return $price;
    }
}
