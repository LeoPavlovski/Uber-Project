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
          'name'=>$this->name,
          'year'=>$this->year,
          'model'=>$this->model,
          'color'=>$this->color,
          'license_plate'=>$this->license_plate
        ];
    }
}
