<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable =[
        'year',
        'model',
        'license_plate',
        'color',
        'name',
        'city',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trips(){
        return $this->belongsToMany(Trip::class);
    }
}

