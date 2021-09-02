<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'role' => '0',
            'password' => bcrypt('admin@123'),
        ]);
    }
}
