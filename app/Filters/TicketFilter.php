<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class TicketFilter extends ApiFilter {

    protected $safeParams = [
        'passengerName' => ['eq'],
        'passengerEmail'=> ['eq'],
        'seatNumber' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'busId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'userId' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [
        'passengerName' => 'passenger_name',
        'passengerEmail'=> 'passenger_email',
        'seatNumber' => 'seat_number',
        'busId' => 'bus_id',
        'userId' => 'user_id',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}
