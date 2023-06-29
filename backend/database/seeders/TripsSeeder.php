<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *   'user_id',
    'driver_id',
    'is_started',
    'is_completed',
    'origin',
    'destination',
    'destination_name',
    'driver_location'

     */
    public function run(): void
    {
        DB::table('trips')->insert(

      [
          [

         'driver_id'=>1,
          'origin'=>json_encode([
              'latitude'=>123.456,
              'longitude'=>78.901,
              'address'=>'Ilindenska,City'
          ]),
            'destination_name'=>"Tetovo-Skopje"
          ],
          [

              'driver_id'=>2,
              'origin'=>json_encode([
                  'latitude'=>123.456,
                  'longitude'=>78.901,
                  'address'=>'Ilindenska,City'
              ]),
              'destination_name'=>"Tetovo-Skopje"
            ],
          [

              'driver_id'=>3,
              'origin'=>json_encode([
                  'latitude'=>123.456,
                  'longitude'=>78.901,
                  'address'=>'Ilindenska,City'
              ]),
              'destination_name'=>"Tetovo-Skopje"
          ],
          [

              'driver_id'=>4,
              'origin'=>json_encode([
                  'latitude'=>123.456,
                  'longitude'=>78.901,
                  'address'=>'Ilindenska,City'
              ]),
              'destination_name'=>"Tetovo-Skopje"
          ]
          ]
        );
    }
}
