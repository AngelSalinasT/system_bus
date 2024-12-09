<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'routeName' => $this->route_name,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'distance' => $this->distance,
            'estimatedTime' => $this->estimated_time,
            'branchId' => $this->branch_id,
            'schedul' => ScheduleResource::collection($this->whenLoaded('schedul')),
        ];
    }
}
