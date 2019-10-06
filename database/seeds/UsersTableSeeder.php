<?php

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

        $admin = new \App\User();
            $admin->username = env('INITIAL_ADMIN_USERNAME');
            $admin->first_name = env('INITIAL_ADMIN_FIRST_NAME');
            $admin->last_name = env('INITIAL_ADMIN_LAST_NAME');
            $admin->email = env('INITIAL_ADMIN_EMAIL');
            $admin->email_verified_at = $now;
            $admin->approved_at = $now;
            $admin->rejected_at = null;
            $admin->password = Hash::make(env('INITIAL_ADMIN_PASSWORD'));
            $admin->is_admin = true;
        $admin->save();

        $user = new \App\User();
            $user->username = env('INITIAL_USER_USERNAME');
            $user->first_name = env('INITIAL_USER_FIRST_NAME');
            $user->last_name = env('INITIAL_USER_LAST_NAME');
            $user->email = env('INITIAL_USER_EMAIL');
            $user->email_verified_at = $now;
            $user->approved_at = $now;
            $user->rejected_at = null;
            $user->password = Hash::make(env('INITIAL_USER_PASSWORD'));
            $user->is_admin = false;
        $user->save();

        $userUnapproved = new \App\User();
            $userUnapproved->username = env('INITIAL_USER_USERNAME_UNAPPROVED');
            $userUnapproved->first_name = env('INITIAL_USER_FIRST_NAME_UNAPPROVED');
            $userUnapproved->last_name = env('INITIAL_USER_LAST_NAME_UNAPPROVED');
            $userUnapproved->email = env('INITIAL_USER_EMAIL_UNAPPROVED');
            $userUnapproved->email_verified_at = $now;
            $userUnapproved->approved_at = null;
            $userUnapproved->rejected_at = null;
            $userUnapproved->password = Hash::make(env('INITIAL_USER_PASSWORD_UNAPPROVED'));
            $userUnapproved->is_admin = false;
        $userUnapproved->save();

        $userRejected = new \App\User();
            $userRejected->username = env('INITIAL_USER_USERNAME_REJECTED');
            $userRejected->first_name = env('INITIAL_USER_FIRST_NAME_REJECTED');
            $userRejected->last_name = env('INITIAL_USER_LAST_NAME_REJECTED');
            $userRejected->email = env('INITIAL_USER_EMAIL_REJECTED');
            $userRejected->email_verified_at = $now;
            $userRejected->approved_at = null;
            $userRejected->rejected_at = $now;
            $userRejected->password = Hash::make(env('INITIAL_USER_PASSWORD_REJECTED'));
            $userRejected->is_admin = false;
        $userRejected->save();
    }
}
