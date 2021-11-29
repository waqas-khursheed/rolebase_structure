<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_roles')->insert([

            [
                'role' => 'Admin',
            ],
            [
                'role' => 'Manager',
            ],
            [
                'role' => 'Operater',
            ]

        ]);

        DB::table('users')->insert([

            [
                'name' => 'Admin',
                'phone' => '03473480380',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456789'),
                'employeerole_id' => 1,
                'right' => "users,category,promotion,product,employee",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
