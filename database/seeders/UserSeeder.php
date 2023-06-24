<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
    'name',
    'phone',
    'login_code',

     */
    public function run(): void
    {
        DB::table('users')->insert([
           [
               'name'=>'Leo',
               'phone'=>'+423432',

           ],
            [
                'name'=>'Marko',
                'phone'=>'+4443',

            ],
            [
                'name'=>'Nikola',
                'phone'=>'+2234',

            ]
            ,[
                'name'=>'Sefer',
                'phone'=>'+5252',

            ]
        ]);
    }
}
