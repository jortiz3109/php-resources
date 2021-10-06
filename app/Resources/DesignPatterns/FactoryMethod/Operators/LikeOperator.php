<?php

namespace App\Resources\DesignPatterns\FactoryMethod\Operators;

use App\Resources\DesignPatterns\FactoryMethod\Operator;
use Illuminate\Database\Query\Builder;

class LikeOperator extends Operator
{
    public function __construct(Builder $query, string $column, string $condition)
    {
        parent::__construct($query, $column, $condition);
    }

    public function query(): Builder
    {
        return $this->query->where($this->column, 'like', "%{$this->condition}%");
    }
}
