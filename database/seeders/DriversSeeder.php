<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *       'user_id',
    'user_id',
    'year',
    'model',
    'license_plate',
    'color',

    'trip_id'
     */
    public function run(): void
    {
        DB::table('drivers')->insert([
            [
              'year'=>2013,
              'model'=>'Aston Martin',
              'license_plate'=>"1234MKD",
              'color'=>'White'
            ],
            [

                'year'=>2004,
                'model'=>'Opel',
                'license_plate'=>"1234MKD",
                'color'=>'White'
            ],
            [

                'year'=>2011,
                'model'=>'Mitsubishi',
                'license_plate'=>"1234MKD",
                'color'=>'White'
            ],
            [

                'year'=>2007,
                'model'=>'Ford',
                'license_plate'=>"1234MKD",
                'color'=>'White'
            ],
        ]);
    }
}
