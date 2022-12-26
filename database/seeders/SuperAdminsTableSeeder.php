<?php

namespace Database\Seeders;

use App\Models\admin\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::insert([
            'name' => 'Peter Parker',
            'email' => 'alliance.ad@email.com',
            'phone' => '0000112346',
            'password' => bcrypt('123456789'),
        ]);
    }
}
