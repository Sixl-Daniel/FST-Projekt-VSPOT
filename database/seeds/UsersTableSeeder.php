<?php

use App\Role;
use App\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        // fetch user roles

        $superadminRole = Role::whereName('Superadmin')->first();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();
        $inspectorRole = Role::whereName('Inspector')->first();
        $testerRole = Role::whereName('Tester')->first();
        $dummyRole = Role::whereName('Dummy')->first();

        // create initial users from .env

        $superadmin = new User();
            $superadmin->username = env('INITIAL_SUPERADMIN_USERNAME');
            $superadmin->first_name = env('INITIAL_SUPERADMIN_FIRST_NAME');
            $superadmin->last_name = env('INITIAL_SUPERADMIN_LAST_NAME');
            $superadmin->email = env('INITIAL_SUPERADMIN_EMAIL');
            $superadmin->email_verified_at = $now;
            $superadmin->password = Hash::make(env('INITIAL_SUPERADMIN_PASSWORD'));
        $superadmin->save();
        $superadmin->roles()->attach($superadminRole);

        $user1 = new User();
            $user1->username = env('INITIAL_USER_USERNAME_1');
            $user1->first_name = env('INITIAL_USER_FIRST_NAME_1');
            $user1->last_name = env('INITIAL_USER_LAST_NAME_1');
            $user1->email = env('INITIAL_USER_EMAIL_1');
            $user1->email_verified_at = $now;
            $user1->password = Hash::make(env('INITIAL_USER_PASSWORD_1'));
        $user1->save();
        $user1->roles()->attach($adminRole);

        $user2 = new User();
            $user2->username = env('INITIAL_USER_USERNAME_2');
            $user2->first_name = env('INITIAL_USER_FIRST_NAME_2');
            $user2->last_name = env('INITIAL_USER_LAST_NAME_2');
            $user2->email = env('INITIAL_USER_EMAIL_2');
            $user2->email_verified_at = $now;
            $user2->password = Hash::make(env('INITIAL_USER_PASSWORD_2'));
        $user2->save();
        $user2->roles()->attach($userRole);

        $user3 = new User();
            $user3->username = env('INITIAL_USER_USERNAME_3');
            $user3->first_name = env('INITIAL_USER_FIRST_NAME_3');
            $user3->last_name = env('INITIAL_USER_LAST_NAME_3');
            $user3->email = env('INITIAL_USER_EMAIL_3');
            $user3->email_verified_at = $now;
            $user3->password = Hash::make(env('INITIAL_USER_PASSWORD_3'));
        $user3->save();
        $user3->roles()->attach($testerRole);
        $user3->roles()->attach($inspectorRole);

        // generate dummy users

        factory(App\User::class, 16)->create()->each(function($user) use ($dummyRole) {
            $user->roles()->attach($dummyRole);
        });

        factory(App\User::class, 8)->create(['email_verified_at'=>null]);
    }
}
