<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'passengerName' => $this->passenger_name,
            'passengerEmail' => $this->passenger_email,
            'seatNumber' => $this->seat_number,
            'busId' => $this->bus_id,
            'userId' => $this->user_id,
        ];
    }
}
