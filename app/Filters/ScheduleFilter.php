<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ScheduleFilter extends ApiFilter {

    protected $safeParams = [
        'routeId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'busId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'date' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'departureTime' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'arrivalTime' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [
        'routeId' => 'route_id',
        'busId' => 'bus_id',
        'departureTime' => 'departure_time',
        'arrivalTime' => 'arrival_time',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}
