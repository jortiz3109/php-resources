<?php

namespace App\Resources\DesignPatterns\Decorator\Decorators;

use App\Resources\DesignPatterns\Decorator\Contracts\AmountFormatterContract;
use NumberFormatter;

abstract class CurrencyDecorator implements AmountFormatterContract
{
    private AmountFormatterContract $amountFormatter;
    public function __construct(AmountFormatterContract $amountFormatter)
    {
        $this->amountFormatter = $amountFormatter;
    }

    public function format(int $price): string
    {
        $numberFormatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        return $numberFormatter->formatCurrency($this->amountFormatter->format($price), $this->currency());
    }

    abstract protected function currency(): string;
}
