<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable =[
      'driver_id',
        'user_id',
      'is_started',
      'is_completed',
      'origin',
      'destination',
      'destination_name',
      'driver_location'
    ];
    protected $casts = [
      'origin'=>'json',
        'destination'=>'json',
        'is_started'=>'boolean',
        'is_completed'=>'boolean',
        'driver_location'=>'array'
    ];
    protected $with = ['user'];
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
