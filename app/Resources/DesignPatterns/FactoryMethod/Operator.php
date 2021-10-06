<?php

namespace App\Resources\DesignPatterns\FactoryMethod;

use App\Resources\DesignPatterns\FactoryMethod\Contracts\OperatorContract;
use Illuminate\Database\Query\Builder;

abstract class Operator implements OperatorContract
{
    protected Builder $query;
    protected string $column;
    protected $condition;

    public function __construct(Builder $query, string $column, $condition)
    {
        $this->query = $query;
        $this->column = $column;
        $this->condition = $condition;
    }

    abstract public function query(): Builder;
}
