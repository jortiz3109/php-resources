<?php

namespace Tests\Unit\DesignPatterns;

use App\Resources\DesignPatterns\FactoryMethod\Contracts\OperatorContract;
use App\Resources\DesignPatterns\FactoryMethod\OperatorFactory;
use App\Resources\DesignPatterns\FactoryMethod\Operators\BetweenOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\EqualsOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\InOperator;
use App\Resources\DesignPatterns\FactoryMethod\Operators\LikeOperator;
use Exception;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testItThrowAnExceptionWhenUnsupportedOperatorWasProvided(): void
    {
        $this->expectException(Exception::class);
        OperatorFactory::createOperator(DB::table('users'), 'nt', 'name', 'john');

    }
    /**
     * @param string $className
     * @param string $operator
     * @param string $column
     * @param string|array $condition
     *
     * @dataProvider operatorClassNamesProvider
     * @throws \Exception
     */
    public function testItCreatesOperators(string $operator, string $column, string|array $condition, string $className): void
    {
        $operatorInstance = OperatorFactory::createOperator(DB::table('users'), $operator, $column, $condition);

        $this->assertInstanceOf($className, $operatorInstance);
        $this->assertInstanceOf(OperatorContract::class, $operatorInstance);
    }

    /**
     * @param string $operator
     * @param string $column
     * @param string|array $condition
     * @param string $sql
     * @throws \Exception
     *
     * @dataProvider operatorQueriesProvider
     */
    public function testItMakesASQLQuery(string $operator, string $column, string|array $condition, string $sql): void
    {
        $query = OperatorFactory::createOperator(DB::table('users'), $operator, $column, $condition)->query();

        $this->assertEquals($query->toSql(), $sql);
    }

    public function operatorQueriesProvider(): array
    {
        $operators = $this->operatorsProvider();
        $queries = [
            'equals' => ['select * from `users` where `name` = ?'],
            'like' => ['select * from `users` where `name` like ?'],
            'in' => ['select * from `users` where `name` in (?, ?)'],
            'between' => ['select * from `users` where `created_at` between ? and ?'],
        ];

        return array_merge_recursive($operators, $queries);
    }

    public function operatorClassNamesProvider(): array
    {
        $operators = $this->operatorsProvider();
        $classNames = [
            'equals' => [EqualsOperator::class],
            'like' => [LikeOperator::class],
            'in' => [InOperator::class],
            'between' => [BetweenOperator::class],
        ];

        return array_merge_recursive($operators, $classNames);
    }

    public function operatorsProvider(): array
    {
        return [
            'equals' => ['eq', 'name', 'john'],
            'like' => ['lk', 'name', 'john'],
            'in' => ['in', 'name', ['john', 'dario']],
            'between' => [
                'bt',
                'created_at',
                [
                    'from' => now()->startOfMonth()->toDateString(),
                    'to' => now()->endOfMonth()->toDateString()
                ]
            ],
        ];
    }
}
