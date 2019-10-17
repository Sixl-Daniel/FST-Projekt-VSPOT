<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Superadmin'],
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Tester'],
            ['name' => 'Dummy']
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
