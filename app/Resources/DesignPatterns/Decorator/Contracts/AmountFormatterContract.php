<?php

namespace App\Resources\DesignPatterns\Decorator\Contracts;

interface AmountFormatterContract
{
    public function format(int $price): string;
}
