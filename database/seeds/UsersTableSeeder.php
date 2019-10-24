<?php

use App\Channel;
use App\Device;
use App\Element;
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
        $now = Carbon::now()->format('Y-m-d H:i:s');

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

        $superadmin = new User();
            $superadmin->username = env('INITIAL_SUPERADMIN_USERNAME');
            $superadmin->first_name = env('INITIAL_SUPERADMIN_FIRST_NAME');
            $superadmin->last_name = env('INITIAL_SUPERADMIN_LAST_NAME');
            $superadmin->email = env('INITIAL_SUPERADMIN_EMAIL');
            $superadmin->email_verified_at = $now;
            $superadmin->password = Hash::make(env('INITIAL_SUPERADMIN_PASSWORD'));
            $superadmin->api_token = Str::random(60);
        $superadmin->save();
        $superadmin->roles()->attach($superadminRole);

        /*
         * create other initial users from .env
         */

        $user1 = new User();
            $user1->username = env('INITIAL_USER_USERNAME_1');
            $user1->first_name = env('INITIAL_USER_FIRST_NAME_1');
            $user1->last_name = env('INITIAL_USER_LAST_NAME_1');
            $user1->email = env('INITIAL_USER_EMAIL_1');
            $user1->email_verified_at = $now;
            $user1->password = Hash::make(env('INITIAL_USER_PASSWORD_1'));
            $user1->api_token = Str::random(60);
        $user1->save();
        $user1->roles()->attach($adminRole);

        $user2 = new User();
            $user2->username = env('INITIAL_USER_USERNAME_2');
            $user2->first_name = env('INITIAL_USER_FIRST_NAME_2');
            $user2->last_name = env('INITIAL_USER_LAST_NAME_2');
            $user2->email = env('INITIAL_USER_EMAIL_2');
            $user2->email_verified_at = $now;
            $user2->password = Hash::make(env('INITIAL_USER_PASSWORD_2'));
            $user2->api_token = Str::random(60);
        $user2->save();
        $user2->roles()->attach($userRole);

        $user3 = new User();
            $user3->username = env('INITIAL_USER_USERNAME_3');
            $user3->first_name = env('INITIAL_USER_FIRST_NAME_3');
            $user3->last_name = env('INITIAL_USER_LAST_NAME_3');
            $user3->email = env('INITIAL_USER_EMAIL_3');
            $user3->email_verified_at = $now;
            $user3->password = Hash::make(env('INITIAL_USER_PASSWORD_3'));
            $user3->api_token = Str::random(60);
        $user3->save();
        $user3->roles()->attach($testerRole);
        $user3->roles()->attach($inspectorRole);

        // generate some verified dummy users
        factory(App\User::class, 16)->create()->each(function($user) use ($dummyRole) {
            $user->roles()->attach($dummyRole);
        });

        // generate some unverified dummy users
        factory(App\User::class, 8)->create(['email_verified_at'=>null]);


        /*
         * generate demo content
         */

        // fetch layouts
        $demoLayout = Layout::whereName('Demo')->first();
        $basicLayout = Layout::whereName('Basic')->first();

        // create a demo channel
        $channelDemo1 = new Channel();
        $channelDemo1->name = "Kanal-1";
        $channelDemo1->description = "Erster Channel für eine kleine Demonstration";
        $channelDemo1->user()->associate($superadmin);
        $channelDemo1->save();

        $channelDemo2 = new Channel();
        $channelDemo2->name = "Kanal-2";
        $channelDemo2->description = "Zweiter Channel für eine kleine Demonstration";
        $channelDemo2->user()->associate($superadmin);
        $channelDemo2->save();

        $channelDemo3 = new Channel();
        $channelDemo3->name = "Kanal-3";
        $channelDemo3->description = "Dritter Channel für eine kleine Demonstration";
        $channelDemo3->user()->associate($superadmin);
        $channelDemo3->save();

        // create a standard device

        $deviceMonitor1 = new Device();
        $deviceMonitor1->display_name = 'Monitor_1';
        $deviceMonitor1->description = 'Mobiler Testmonitor mit Raspberry Pi "Gamma"';
        $deviceMonitor1->product_reference = 'Samsung SyncMaster 2253BW';
        $deviceMonitor1->location = 'Wohnzimmer';
        $deviceMonitor1->user()->associate($superadmin);
        $deviceMonitor1->channel()->associate($channelDemo1);
        $deviceMonitor1->save();

        $deviceMonitor2 = new Device();
        $deviceMonitor2->display_name = 'Monitor_2';
        $deviceMonitor2->description = 'Mobiler Testmonitor mit Raspberry Pi "Delta"';
        $deviceMonitor2->product_reference = 'HP Envy 27';
        $deviceMonitor2->location = 'Wohnzimmer';
        $deviceMonitor2->user()->associate($superadmin);
        $deviceMonitor2->channel()->associate($channelDemo1);
        $deviceMonitor2->save();

        $deviceMonitor3 = new Device();
        $deviceMonitor3->display_name = 'Monitor_3';
        $deviceMonitor2->description = 'Mobiler Testmonitor mit Raspberry Pi "Epsilon"';
        $deviceMonitor3->user()->associate($superadmin);
        $deviceMonitor3->channel()->associate($channelDemo1);
        $deviceMonitor3->save();

        // now make some screens with a layout for that channel

        $screen1 = new Screen();
        $screen1->name = "Intro";
        $screen1->description = "Erster Screen";
        $screen1->background_color = "#000000";
        $screen1->text_color = "#FFFFFF";
        $screen1->heading = "Willkommen";
        $screen1->layout()->associate($demoLayout);
        $screen1->channel()->associate($channelDemo1);
        $screen1->save();

        $screen2 = new Screen();
        $screen2->name = "Slide-1";
        $screen2->description = "Zweiter Screen";
        $screen2->background_color = "#FFFFFF";
        $screen2->text_color = "#000000";
        $screen2->heading = "VSPOT";
        $screen2->subheading = "Digital Signage Solution";
        $screen2->layout()->associate($basicLayout);
        $screen2->channel()->associate($channelDemo1);
        $screen2->save();

        $screen3 = new Screen();
        $screen3->name = "Slide-2";
        $screen3->description = "Dritter Screen";
        $screen3->background_color = "#FFFFFF";
        $screen3->text_color = "#000000";
        $screen3->heading = "Autoren";
        $screen3->subheading = "Stefan Süß & Daniel Sixl";
        $screen3->layout()->associate($basicLayout);
        $screen3->channel()->associate($channelDemo1);
        $screen3->channel()->associate($channelDemo2);
        $screen3->save();

    }
}
