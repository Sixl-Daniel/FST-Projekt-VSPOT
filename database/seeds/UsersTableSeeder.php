<?php

use App\Channel;
use App\Device;
use App\Element;
use App\Helper;
use App\Layout;
use App\Role;
use App\User;
use App\Screen;

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

        /*
         * fetch user roles
         */

        $superadminRole = Role::whereName('Superadmin')->first();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();
        $inspectorRole = Role::whereName('Inspector')->first();
        $testerRole = Role::whereName('Tester')->first();
        $dummyRole = Role::whereName('Dummy')->first();

        /*
         * create initial superadmin from .env
         */

        $randomDate = Helper::getRandomRegisterDate();

        $superadmin = new User();
        $superadmin->username = env('INITIAL_SUPERADMIN_USERNAME');
        $superadmin->first_name = env('INITIAL_SUPERADMIN_FIRST_NAME');
        $superadmin->last_name = env('INITIAL_SUPERADMIN_LAST_NAME');
        $superadmin->email = env('INITIAL_SUPERADMIN_EMAIL');
        $superadmin->created_at = $randomDate['created'];
        $superadmin->updated_at = $randomDate['created'];
        $superadmin->email_verified_at = $randomDate['verified'];
        $superadmin->password = Hash::make(env('INITIAL_SUPERADMIN_PASSWORD'));
        $superadmin->api_token = env('INITIAL_SUPERADMIN_API_TOKEN');
        $superadmin->save();
        $superadmin->roles()->attach($superadminRole);

        /*
         * create initial admin from .env
         */

        $randomDate = Helper::getRandomRegisterDate();

        $admin = new User();
        $admin->username = env('INITIAL_ADMIN_USERNAME');
        $admin->first_name = env('INITIAL_ADMIN_FIRST_NAME');
        $admin->last_name = env('INITIAL_ADMIN_LAST_NAME');
        $admin->email = env('INITIAL_ADMIN_EMAIL');
        $admin->created_at = $randomDate['created'];
        $admin->updated_at = $randomDate['created'];
        $admin->email_verified_at = $randomDate['verified'];
        $admin->password = Hash::make(env('INITIAL_ADMIN_PASSWORD'));
        $admin->api_token = env('INITIAL_ADMIN_API_TOKEN');
        $admin->save();
        $admin->roles()->attach($adminRole);

        /*
         * create other initial users from .env
         */

        $randomDate = Helper::getRandomRegisterDate();

        $user1 = new User();
            $user1->username = env('INITIAL_USER_USERNAME_1');
            $user1->first_name = env('INITIAL_USER_FIRST_NAME_1');
            $user1->last_name = env('INITIAL_USER_LAST_NAME_1');
            $user1->email = env('INITIAL_USER_EMAIL_1');
            $user1->created_at = $randomDate['created'];
            $user1->updated_at = $randomDate['created'];
            $user1->email_verified_at = $randomDate['verified'];
            $user1->password = Hash::make(env('INITIAL_USER_PASSWORD_1'));
            $user1->api_token = env('INITIAL_USER_API_TOKEN_1');
        $user1->save();
        $user1->roles()->attach($userRole);

        $randomDate = Helper::getRandomRegisterDate();

        $user2 = new User();
            $user2->username = env('INITIAL_USER_USERNAME_2');
            $user2->first_name = env('INITIAL_USER_FIRST_NAME_2');
            $user2->last_name = env('INITIAL_USER_LAST_NAME_2');
            $user2->email = env('INITIAL_USER_EMAIL_2');
            $user2->created_at = $randomDate['created'];
            $user2->updated_at = $randomDate['created'];
            $user2->email_verified_at = $randomDate['verified'];
            $user2->password = Hash::make(env('INITIAL_USER_PASSWORD_2'));
            $user2->api_token = env('INITIAL_USER_API_TOKEN_2');
        $user2->save();
        $user2->roles()->attach($userRole);

        $randomDate = Helper::getRandomRegisterDate();

        $user3 = new User();
            $user3->username = env('INITIAL_USER_USERNAME_3');
            $user3->first_name = env('INITIAL_USER_FIRST_NAME_3');
            $user3->last_name = env('INITIAL_USER_LAST_NAME_3');
            $user3->email = env('INITIAL_USER_EMAIL_3');
            $user3->created_at = $randomDate['created'];
            $user3->updated_at = $randomDate['created'];
            $user3->email_verified_at = $randomDate['verified'];
            $user3->password = Hash::make(env('INITIAL_USER_PASSWORD_3'));
            $user3->api_token = env('INITIAL_USER_API_TOKEN_3');
        $user3->save();
        $user3->roles()->attach($testerRole);
        $user3->roles()->attach($inspectorRole);

        // generate some verified dummy users
        factory(App\User::class, 16)->create()->each(function($user) use ($dummyRole) {
            $user->roles()->attach($dummyRole);
        });

        // generate some unverified dummy users
        factory(App\User::class, 8)->create(['email_verified_at'=>null]);

    }
}
