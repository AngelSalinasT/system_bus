<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class RouteFilter extends ApiFilter {

    protected $safeParams = [
        'routeName' => ['eq'],
        'origin' => ['eq'],
        'destination' => ['eq'],
        'distance' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'estimatedTime' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'branchId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [
        'routeName' => 'route_name',
        'estimatedTime' => 'estimated_time',
        'branchId' => 'branch_id',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}
