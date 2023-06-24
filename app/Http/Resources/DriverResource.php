<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'year' => $this->resource->year,
            'model' => $this->resource->model,
            'color' => $this->resource->color,
            'license_plate' => $this->resource->license_plate,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
