<?php

namespace App\Resources\DesignPatterns\FactoryMethod;

use App\Resources\DesignPatterns\FactoryMethod\Contracts\OperatorContract;
use App\Resources\DesignPatterns\FactoryMethod\Operators\BetweenOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\EqualsOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\InOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\LikeOperator;
use Exception;
use Illuminate\Database\Query\Builder;

class OperatorFactory
{
    private static array $supported = [
        'eq' => EqualsOperator::class,
        'lk' => LikeOperator::class,
        'bt' => BetweenOperator::class,
        'in' => InOperator::class
    ];

    /**
     * @throws Exception
     */
    public static function createOperator(Builder $query, string $operator, string $column, string|array $condition): OperatorContract
    {
        if (array_key_exists($operator, self::$supported)) {
            return new self::$supported[$operator]($query, $column, $condition);
        }

        throw new Exception('Unsupported operator');
    }
}
