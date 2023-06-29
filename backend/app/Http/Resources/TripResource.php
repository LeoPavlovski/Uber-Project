<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *   $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users');
    $table->unsignedBigInteger('driver_id');
    $table->foreign('driver_id')->references('id')->on('drivers');
    $table->boolean('is_started')->default(false);
    $table->boolean('is_completed')->default(false);
    $table->json('origin')->nullable();
    $table->json('destination')->nullable();
    $table->string('destination_name')->nullable();
    $table->json('driver_location')->nullable();
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'origin' => $this->origin,
           'destination' => $this->destination,
           'destination_name' => $this->destination_name,
//            'user_id'=>$this->user->id,
            'id'=>$this->id,
            'user_id'=>$this->user->id,
        ];
    }
}
