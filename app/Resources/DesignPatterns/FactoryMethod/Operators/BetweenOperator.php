<?php

namespace App\Resources\DesignPatterns\FactoryMethod\Operators;

use App\Resources\DesignPatterns\FactoryMethod\Operator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class BetweenOperator extends Operator
{
    public function __construct(Builder $query, string $column, array $condition)
    {
        parent::__construct($query, $column, $condition);
    }

    public function query(): Builder
    {
        return $this->query->whereBetween($this->column, Arr::only($this->condition, ['from', 'to']));
    }
}
