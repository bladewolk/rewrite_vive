<?php

use Illuminate\Database\Seeder;

class DeviceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            [
                'device_id' => '1',
                'name' => 'Oculus',
            ],
            [
                'device_id' => '2',
                'name' => 'HTC Vive',
            ]
        ]);
    }
}
