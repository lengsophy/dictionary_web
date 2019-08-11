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
        DB::table('users')->delete();

        DB::table('role_user')->delete();

        DB::table('roles')->delete();

        DB::table('permission_role')->delete();

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin123')]
        ]);

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'display_name' => 'Admin', 'description' => 'Admin User', 'key' => 'admin', 'created_at' => '2016-04-17 00:00:00','updated_at' => '2016-04-17 00:00:00'],
        ]);

        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => '1'],
        ]);

        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => '1'],
            ['permission_id' => 2, 'role_id' => '1'],
            ['permission_id' => 3, 'role_id' => '1'],
        ]);
    }
}
