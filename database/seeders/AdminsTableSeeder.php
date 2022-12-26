<?php

namespace Database\Seeders;

use App\Models\admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => 'Brian Bobby Brown',
            'email' => 'bobby.ad@email.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
