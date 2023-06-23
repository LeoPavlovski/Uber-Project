<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable =[
      'user_id',
      'drover_id',
      'is_started',
      'is_completed',
      'origin',
      'destination',
      'destination_name',
      'driver_location'
    ];
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
