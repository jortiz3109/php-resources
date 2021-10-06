<?php

namespace App\Resources\DesignPatterns\FactoryMethod\Operators;

use App\Resources\DesignPatterns\FactoryMethod\Operator;
use Illuminate\Database\Query\Builder;

class InOperator extends Operator
{
    public function __construct(Builder $query, string $column, array $condition)
    {
        parent::__construct($query, $column, $condition);
    }

    public function query(): Builder
    {
        return $this->query->whereIn($this->column, $this->condition);
    }
}
