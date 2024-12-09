<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class BranchFilter extends ApiFilter {

    protected $safeParams = [
        'name' => ['eq'],
        'address' => ['eq'],
        'phone' => ['eq'],
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
