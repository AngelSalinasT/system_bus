<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'routeId' => $this->route_id,
            'busId' => $this->bus_id,
            'date' => $this->date,
            'departureTime' => $this->departure_time,
            'arrivalTime' => $this->arrival_time,
            'ticket' => TicketResource::collection($this->whenLoaded('tickets')),
        ];
    }
}
