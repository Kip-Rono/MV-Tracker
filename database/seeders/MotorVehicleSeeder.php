<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('motor_vehicle')->insert([
            'name' => 'admin',
            'reg_no' => 'OXY L404',
            'year_of_man' => '2016',
            'vehicle_type' => 'Open Truck',
            'tonnage' => '13',
            //'email' => str_random(10).'@gmail.com',
            //'password' => bcrypt('secret'),
        ]);

        DB::table('motor_vehicle')->insert([
            'name' => 'john',
            'reg_no' => 'NTX K504',
            'year_of_man' => '2015',
            'vehicle_type' => 'Pick Up Truck',
            'tonnage' => '7',
        ]);

        DB::table('motor_vehicle')->insert([
            'name' => 'jane',
            'reg_no' => 'LST M001',
            'year_of_man' => '2013',
            'vehicle_type' => 'Refrigerated Truck',
            'tonnage' => '20',
        ]);
    }
}
