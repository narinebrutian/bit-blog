<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Peter Parker',
            'email' => 'alliance.ad@email.com',
            'phone' => '0000112346',
            'password' => bcrypt('123456789'),
        ]);
    }
}
