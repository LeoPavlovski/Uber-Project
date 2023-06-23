<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'year',
        'model',
        'license_plate',
        'color'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}

