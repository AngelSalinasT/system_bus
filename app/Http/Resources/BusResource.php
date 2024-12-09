<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'plates' => $this->plates,
            'model' => $this->model,
            'capacity' => $this->capacity,
            'schedul' => ScheduleResource::collection($this->whenLoaded('schedul')),
        ];
    }
}
