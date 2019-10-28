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
            $superadmin->api_token = env('INITIAL_SUPERADMIN_API_TOKEN');
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
            $user1->api_token = env('INITIAL_USER_API_TOKEN_1');
        $user1->save();
        $user1->roles()->attach($adminRole);

        $user2 = new User();
            $user2->username = env('INITIAL_USER_USERNAME_2');
            $user2->first_name = env('INITIAL_USER_FIRST_NAME_2');
            $user2->last_name = env('INITIAL_USER_LAST_NAME_2');
            $user2->email = env('INITIAL_USER_EMAIL_2');
            $user2->email_verified_at = $now;
            $user2->password = Hash::make(env('INITIAL_USER_PASSWORD_2'));
            $user2->api_token = env('INITIAL_USER_API_TOKEN_2');
        $user2->save();
        $user2->roles()->attach($userRole);

        $user3 = new User();
            $user3->username = env('INITIAL_USER_USERNAME_3');
            $user3->first_name = env('INITIAL_USER_FIRST_NAME_3');
            $user3->last_name = env('INITIAL_USER_LAST_NAME_3');
            $user3->email = env('INITIAL_USER_EMAIL_3');
            $user3->email_verified_at = $now;
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


        /*
         * generate demo content
         */

        // fetch layouts
        $testLayout = Layout::whereName('Test')->first();
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

        $channelDemo4 = new Channel();
        $channelDemo4->name = "Kanal-4";
        $channelDemo4->description = "Vierter Channel für eine kleine Demonstration";
        $channelDemo4->user()->associate($superadmin);
        $channelDemo4->save();

        $channelDemo5 = new Channel();
        $channelDemo5->name = "Testkanal";
        $channelDemo5->description = "Ausgabe eines Testbildschirms mit Informationen";
        $channelDemo5->user()->associate($superadmin);
        $channelDemo5->save();

        $channelDemo6 = new Channel();
        $channelDemo6->name = "Elemente";
        $channelDemo6->description = "Testen von Farben und Hintergrundbild";
        $channelDemo6->user()->associate($superadmin);
        $channelDemo6->save();


        // create a standard device

        $deviceMonitor1 = new Device();
        $deviceMonitor1->display_name = 'Monitor_1';
        $deviceMonitor1->description = 'Mobiler Testmonitor mit Raspberry Pi "Gamma"';
        $deviceMonitor1->product_reference = 'Samsung SyncMaster 2253BW';
        $deviceMonitor1->location = 'Wohnzimmer';
        $deviceMonitor1->user()->associate($superadmin);
        $deviceMonitor1->channel()->associate($channelDemo6);
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

        $screen_1_1 = new Screen();
        $screen_1_1->name = "Intro";
        $screen_1_1->description = "Zeigt die Nummer des Kanals an";
        $screen_1_1->background_color = "#000000";
        $screen_1_1->text_color = "#FFFFFF";
        $screen_1_1->heading = "Kanal 1";
        $screen_1_1->layout()->associate($basicLayout);
        $screen_1_1->channel()->associate($channelDemo1);
        $screen_1_1->save();

        $screen_1_2 = new Screen();
        $screen_1_2->name = "Projektname";
        $screen_1_2->description = "Zeigt zweizeilig das Branding";
        $screen_1_2->background_color = "#FFFFFF";
        $screen_1_2->text_color = "#000000";
        $screen_1_2->heading = "VSPOT";
        $screen_1_2->subheading = "Digital Signage Solution";
        $screen_1_2->layout()->associate($basicLayout);
        $screen_1_2->channel()->associate($channelDemo1);
        $screen_1_2->save();

        $screen_1_3 = new Screen();
        $screen_1_3->name = "Autoren";
        $screen_1_3->description = "Zeigt Daniel Sixl und Stefan Süß";
        $screen_1_3->background_color = "#C70038";
        $screen_1_3->text_color = "#FFFFFF";
        $screen_1_3->heading = "Autoren";
        $screen_1_3->subheading = "Stefan Süß & Daniel Sixl";
        $screen_1_3->layout()->associate($basicLayout);
        $screen_1_3->channel()->associate($channelDemo1);
        $screen_1_3->save();

        $screen_1_4 = new Screen();
        $screen_1_4->name = "Danke";
        $screen_1_4->description = "Zeigt Danke";
        $screen_1_4->background_color = "#0074D9";
        $screen_1_4->text_color = "#FFFFFF";
        $screen_1_4->heading = "Vielen Dank!";
        $screen_1_4->layout()->associate($basicLayout);
        $screen_1_4->channel()->associate($channelDemo1);
        $screen_1_4->save();

        $screen_1_5 = new Screen();
        $screen_1_5->name = "Danke";
        $screen_1_5->description = "Zeigt Verabschiedung";
        $screen_1_5->background_color = "#FFDC00";
        $screen_1_5->text_color = "#000000";
        $screen_1_5->heading = "Ciao...";
        $screen_1_5->layout()->associate($basicLayout);
        $screen_1_5->channel()->associate($channelDemo1);
        $screen_1_5->save();

        $screen_2_1 = new Screen();
        $screen_2_1->name = "Intro";
        $screen_2_1->description = "Zeigt die Nummer des Kanals an";
        $screen_2_1->background_color = "#3D9970";
        $screen_2_1->text_color = "#FFFFFF";
        $screen_2_1->heading = "Kanal 2";
        $screen_2_1->layout()->associate($basicLayout);
        $screen_2_1->channel()->associate($channelDemo2);
        $screen_2_1->save();

        $screen_2_2 = new Screen();
        $screen_2_2->name = "Projektname";
        $screen_2_2->description = "Zeigt zweizeilig das Branding";
        $screen_2_2->background_color = "#7FDBFF";
        $screen_2_2->text_color = "#000000";
        $screen_2_2->heading = "VSPOT";
        $screen_2_2->subheading = "Digital Signage Solution";
        $screen_2_2->layout()->associate($basicLayout);
        $screen_2_2->channel()->associate($channelDemo2);
        $screen_2_2->save();

        $screen_2_2 = new Screen();
        $screen_2_2->name = "Projektname";
        $screen_2_2->description = "Zeigt zweizeilig das Branding";
        $screen_2_2->background_color = "#B10DC9";
        $screen_2_2->text_color = "#FFFFFF";
        $screen_2_2->heading = "12:00";
        $screen_2_2->subheading = "Mittagspause";
        $screen_2_2->layout()->associate($basicLayout);
        $screen_2_2->channel()->associate($channelDemo2);
        $screen_2_2->save();

        $screen_3_1 = new Screen();
        $screen_3_1->name = "Intro";
        $screen_3_1->description = "Zeigt die Nummer des Kanals an";
        $screen_3_1->background_color = "#F012BE";
        $screen_3_1->text_color = "#FFFFFF";
        $screen_3_1->heading = "Kanal 3";
        $screen_3_1->layout()->associate($basicLayout);
        $screen_3_1->channel()->associate($channelDemo3);
        $screen_3_1->save();

        $screen_3_2 = new Screen();
        $screen_3_2->name = "Zweiter Slide";
        $screen_3_2->description = "Wechselt auf das Test-Layout";
        $screen_3_2->background_color = "#000000";
        $screen_3_2->text_color = "#FAFAFA";
        $screen_3_2->heading = "Guten Tag";
        $screen_3_2->subheading = "Dies ist eine weitere Demonstration";
        $screen_3_2->layout()->associate($basicLayout);
        $screen_3_2->channel()->associate($channelDemo3);
        $screen_3_2->save();

        $screen_4_1 = new Screen();
        $screen_4_1->name = "Test";
        $screen_4_1->description = "Anzeige Test-Layout";
        $screen_4_1->background_color = "#000000";
        $screen_4_1->text_color = "#FAFAFA";
        $screen_4_1->layout()->associate($testLayout);
        $screen_4_1->channel()->associate($channelDemo5);
        $screen_4_1->save();

        // Impressionen

        $linkCdn = 'https://picsum.photos/';
        $imgWidth = 1600;
        $imgHeight = 900;
        $imgFileExt = "webp";

        $screen_6_1 = new Screen();
        $screen_6_1->name = "Impressionen-1";
        $screen_6_1->description = "Testen von Farben und Bild";
        $screen_6_1->background_color = "rgb(0,0,0)";
        $screen_6_1->overlay_color = "rgba(0, 0, 0, 0.5)";
        $screen_6_1->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?grayscale&random=1" . "." . $imgFileExt;
        $screen_6_1->text_color = "rgb(255, 255, 255)";
        $screen_6_1->heading = "Impressionen";
        $screen_6_1->layout()->associate($basicLayout);
        $screen_6_1->channel()->associate($channelDemo6);
        $screen_6_1->save();

        $screen_6_2 = new Screen();
        $screen_6_2->name = "Impressionen-2";
        $screen_6_2->description = "Testen von Farben und Bild";
        $screen_6_2->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=2" . "." . $imgFileExt;
        $screen_6_2->layout()->associate($basicLayout);
        $screen_6_2->channel()->associate($channelDemo6);
        $screen_6_2->save();

        $screen_6_3 = new Screen();
        $screen_6_3->name = "Impressionen-3";
        $screen_6_3->description = "Testen von Farben und Bild";;
        $screen_6_3->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=3" . "." . $imgFileExt;
        $screen_6_3->layout()->associate($basicLayout);
        $screen_6_3->channel()->associate($channelDemo6);
        $screen_6_3->save();

        $screen_6_4 = new Screen();
        $screen_6_4->name = "Impressionen-4";
        $screen_6_4->description = "Testen von Farben und Bild";
        $screen_6_4->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=4" . "." . $imgFileExt;
        $screen_6_4->layout()->associate($basicLayout);
        $screen_6_4->channel()->associate($channelDemo6);
        $screen_6_4->save();

        $screen_6_5 = new Screen();
        $screen_6_5->name = "Impressionen-5";
        $screen_6_5->description = "Testen von Farben und Bild";
        $screen_6_5->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=5" . "."  . $imgFileExt;
        $screen_6_5->layout()->associate($basicLayout);
        $screen_6_5->channel()->associate($channelDemo6);
        $screen_6_5->save();

        $screen_6_6 = new Screen();
        $screen_6_6->name = "Impressionen-6";
        $screen_6_6->description = "Testen von Farben und Bild";
        $screen_6_6->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=6" .".". $imgFileExt;
        $screen_6_6->layout()->associate($basicLayout);
        $screen_6_6->channel()->associate($channelDemo6);
        $screen_6_6->save();

        $screen_6_7 = new Screen();
        $screen_6_7->name = "Impressionen-7";
        $screen_6_7->description = "Testen von Farben und Bild";
        $screen_6_7->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=7" . "." . $imgFileExt;
        $screen_6_7->layout()->associate($basicLayout);
        $screen_6_7->channel()->associate($channelDemo6);
        $screen_6_7->save();

        $screen_6_8 = new Screen();
        $screen_6_8->name = "Impressionen-8";
        $screen_6_8->description = "Testen von Farben und Bild";
        $screen_6_8->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=8" . "." . $imgFileExt;
        $screen_6_8->layout()->associate($basicLayout);
        $screen_6_8->channel()->associate($channelDemo6);
        $screen_6_8->save();

        $screen_6_9 = new Screen();
        $screen_6_9->name = "Impressionen-9";
        $screen_6_9->description = "Testen von Farben und Bild";
        $screen_6_9->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=9" . "." . $imgFileExt;
        $screen_6_9->layout()->associate($basicLayout);
        $screen_6_9->channel()->associate($channelDemo6);
        $screen_6_9->save();

        $screen_6_10 = new Screen();
        $screen_6_10->name = "Impressionen-10";
        $screen_6_10->description = "Testen von Farben und Bild";
        $screen_6_10->background_color = "rgb(0,0,0)";
        $screen_6_10->overlay_color = "rgba(0, 0, 0, 0.5)";
        $screen_6_10->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=10" . "." . $imgFileExt;
        $screen_6_10->text_color = "rgb(255, 255, 255)";
        $screen_6_10->heading = "Ende";
        $screen_6_10->layout()->associate($basicLayout);
        $screen_6_10->channel()->associate($channelDemo6);
        $screen_6_10->save();

    }
}
