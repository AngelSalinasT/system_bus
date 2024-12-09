<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class BusFilter extends ApiFilter {

    protected $safeParams = [
        'plates' => ['eq'],
        'model' => ['eq'],
        'capacity' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}
