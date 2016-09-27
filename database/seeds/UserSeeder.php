<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Alex User',
                'email' => 'alex@alex',
                'password' => bcrypt('123qwe'),
                'isAdmin' => false,
            ],
            [
                'name' => 'Alex Admin',
                'email' => 'alex@admin',
                'password' => bcrypt('123qwe'),
                'isAdmin' => true,
            ]
        ]);
    }
}
