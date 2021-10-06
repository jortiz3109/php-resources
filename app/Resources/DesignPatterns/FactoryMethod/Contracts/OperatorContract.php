<?php
namespace App\Resources\DesignPatterns\FactoryMethod\Contracts;

use Illuminate\Database\Query\Builder;

interface OperatorContract
{
    public function query(): Builder;
}
