<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        DB::table('permissions')->insert([
            ['id' => '1','name' => 'dashboard','display_name' => 'Dashboard','description' => 'Dashboard Management'],
            ['id' => '2','name' => 'admin_user','display_name' => 'Admin User','description' => 'Admin User Management'],
            ['id' => '3','name' => 'role_permission','display_name' => 'Role & Permission','description' => 'Role & Permission'],
        ]);
    }
}
