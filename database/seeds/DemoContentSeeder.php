<?php

use App\Channel;
use App\Device;
use App\Layout;
use App\Screen;
use App\User;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run()
    {

        // define colors

        $colors = [
            'black' => 'rgb(0,0,0)',
            'white' => 'rgb(255,255,255)',
            'primary' => 'rgb(199,0,56)',
            'grey-nero' => 'rgb(43,43,43)',
        ];

        $colorsOverlay = [
            'black25' => 'rgba(0,0,0,0.25)',
            'black50' => 'rgba(0,0,0,0.50)',
            'black75' => 'rgba(0,0,0,0.75)',
        ];

        $colorsWeb = [
            "#1a1334","#26294a","#01545a",
            "#017351","#03c383","#aad962",
            "#fbbf45","#ef6a32","#ed0345",
            "#a12a5e","#710162","#110141"
        ];

        // fetch main users (superadmin & admin)

        $superadmin = User::whereUsername(env('INITIAL_SUPERADMIN_USERNAME'))->first();
        $admin = User::whereUsername(env('INITIAL_ADMIN_USERNAME'))->first();

        // fetch layouts for screens

        $testLayout = Layout::whereName('Test')->first();
        $basicLayout = Layout::whereName('Basic')->first();
        $htmlLayout = Layout::whereName('HTML')->first();

        // Links and image data

        $linkCDN = 'https://res.cloudinary.com/sixl/image/upload/';
        $linkPicsum = 'https://picsum.photos/';
        $imgWidth = 3200;
        $imgHeight = 1800;
        $imgFileExt = "webp";

        /*
         * CREATE DEVICES FOR SUPERADMIN
         */

        $deviceVSPOT1 = new Device();
        $deviceVSPOT1->display_name = 'Philips_32';
        $deviceVSPOT1->description = 'LED-TV 32 Zoll, mit Raspberry Pi 3B+ "VSPOT-1" in silbernem Vesa-Case';
        $deviceVSPOT1->product_reference = 'Philips 32PFL5606H';
        $deviceVSPOT1->user()->associate($superadmin);
        $deviceVSPOT1->save();
        $deviceVSPOT1->update(['api_token' => 'XIJVBa813uogjjwJyX4Gp9IN4XjNihGjGk7wuugQtHr9x']);

        $deviceVSPOT2 = new Device();
        $deviceVSPOT2->display_name = 'Toshiba_50';
        $deviceVSPOT2->description = 'LCD-TV 50 Zoll, mit Raspberry Pi 4B+ "VSPOT-2" in Flirc-Case';
        $deviceVSPOT2->product_reference = 'Toshiba 50L4333D';
        $deviceVSPOT2->user()->associate($superadmin);
        $deviceVSPOT2->save();
        $deviceVSPOT2->update(['api_token' => 'fJGNkUNVMY5jGFKMD0JPGS371W27FEATBszPvj6n3FgHS']);

        $deviceVSPOT3 = new Device();
        $deviceVSPOT3->display_name = 'Samsung_22';
        $deviceVSPOT3->description = 'LCD-Monitor 22 Zoll, mit Raspberry Pi 2 "VSPOT-3" in schwarzem Case';
        $deviceVSPOT3->product_reference = 'Samsung 2253BW';
        $deviceVSPOT3->user()->associate($superadmin);
        $deviceVSPOT3->save();
        $deviceVSPOT3->update(['api_token' => 'Qszo0RUI44uabgZzgZpVwD126mzov76rLgsxkpE3dOhmj']);

        $deviceDemo = new Device();
        $deviceDemo->display_name = 'Demo';
        $deviceDemo->description = 'Kein physikalisches Gerät, flexible Verwendung für Demos und Tests';
        $deviceDemo->user()->associate($superadmin);
        $deviceDemo->save();
        $deviceDemo->update(['api_token' => 'GAA2GzBawsTNoUteFGkF84D4FFvY5dSKcvqsWaMgyViic']);

        /*
         * CREATE DEVICE FOR ADMIN
         */

        $deviceDemoAdmin = new Device();
        $deviceDemoAdmin->display_name = 'Demo';
        $deviceDemoAdmin->description = 'Kein physikalisches Gerät, flexible Verwendung für Demos und Tests';
        $deviceDemoAdmin->user()->associate($admin);
        $deviceDemoAdmin->save();
        $deviceDemoAdmin->update(['api_token' => 'kQy24i57RTEvlOIHLVXCr0h19i503VPY6849O1pJwBSKv']);

        /*
         * CREATE CHANNEL "Information"
         */

        $channel_information = new Channel();
        $channel_information->name = 'Information';
        $channel_information->description = 'Ausgabe eines Testbildschirms mit Informationen';
        $channel_information->user()->associate($superadmin);
        $channel_information->save();
        $channel_information_admin = $channel_information->replicate();
        $channel_information_admin->user()->associate($admin);
        $channel_information_admin->push();

        // Screens des Channels "Information"

        $screen_information = new Screen();
        $screen_information->name = 'Information';
        $screen_information->description = 'Anzeige des Test-Layouts mit Basisinformationen';
        $screen_information->background_color = $colors['black'];
        $screen_information->text_color = $colors['white'];
        $screen_information->layout()->associate($testLayout);
        $screen_information->channel()->associate($channel_information);
        $screen_information->save();
        $screen_information->replicate()->channel()->associate($channel_information_admin)->push();

        /*
         * CREATE CHANNEL "Testing"
         */

        $channel_testing = new Channel();
        $channel_testing->name = 'Testing';
        $channel_testing->description = 'Channel mit einigen einfachen Screens';
        $channel_testing->display_time = 1000;
        $channel_testing->transition_time = 250;
        $channel_testing->user()->associate($superadmin);
        $channel_testing->save();
        $channel_testing_admin = $channel_testing->replicate();
        $channel_testing_admin->user()->associate($admin);
        $channel_testing_admin->push();

        // Screens des Channels "Testing"

        for($loop=0; $loop < count($colorsWeb); $loop++) {
            $hex = str_replace('#','', $colorsWeb[$loop]);
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
            $bgColor = 'rgb('.$r.','.$g.','.$b.')';
            $fgColor = (($r*0.299 + $g*0.587 + $b*0.114) > 150) ? $colors['black'] : $colors['white'];
            $padLoop = str_pad($loop+1, 2, '0', STR_PAD_LEFT);
            $screen_testing = new Screen();
            $screen_testing->name = 'Testing-'.$padLoop;
            $screen_testing->background_color = $bgColor;
            $screen_testing->text_color = $fgColor;
            $screen_testing->heading = $loop+1 . '. Screen';
            $screen_testing->layout()->associate($basicLayout);
            $screen_testing->channel()->associate($channel_testing);
            $screen_testing->save();
            $screen_testing->replicate()->channel()->associate($channel_testing_admin)->push();
        }

        /*
         * CREATE CHANNEL "TestingPerformance"
         */

        $channel_performance = new Channel();
        $channel_performance->name = "Testing-Performance";
        $channel_performance->description = "Channel mit 100 Screens, Basic";
        $channel_performance->display_time = 500;
        $channel_performance->transition_time = 250;
        $channel_performance->user()->associate($superadmin);
        $channel_performance->save();
        $channel_performance_admin = $channel_performance->replicate();
        $channel_performance_admin->user()->associate($admin);
        $channel_performance_admin->push();

        // Screens des Channels "Testing-Performance"

        $countScreensChannelPerformance = 100;
        for($loop=1; $loop <= $countScreensChannelPerformance; $loop++) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            $bgColor = 'rgb('.$r.','.$g.','.$b.')';
            $fgColor = (($r*0.299 + $g*0.587 + $b*0.114) > 150) ? $colors['black'] : $colors['white'];
            $padLoop = str_pad($loop, 3, '0', STR_PAD_LEFT);
            $screen_performance = new Screen();
            $screen_performance->name = "Testing-Performance-$padLoop";
            $screen_performance->description = "$loop. Screen des Channels „Testing-Performance“";
            $screen_performance->background_color = $bgColor;
            $screen_performance->text_color = $fgColor;
            $screen_performance->heading = "$loop. Screen";
            $screen_performance->subheading = "Bildschirm $padLoop/$countScreensChannelPerformance";
            $screen_performance->layout()->associate($basicLayout);
            $screen_performance->channel()->associate($channel_performance);
            $screen_performance->save();
            $screen_performance->replicate()->channel()->associate($channel_performance_admin)->push();
        }

        /*
         * CREATE CHANNEL "Impressionen"
         */

        $channel_impressionen = new Channel();
        $channel_impressionen->name = "Impressionen";
        $channel_impressionen->description = "Eine Sammlung von Stimmungsbildern";
        $channel_impressionen->user()->associate($superadmin);
        $channel_impressionen->save();
        $channel_impressionen_admin = $channel_impressionen->replicate();
        $channel_impressionen_admin->user()->associate($admin);
        $channel_impressionen_admin->push();

        // Screens des Channels "Impressionen"

        $screen_impressionen_first = new Screen();
        $screen_impressionen_first->name = "Impression 00 (Intro)";
        $screen_impressionen_first->background_color = $colors['black'];
        $screen_impressionen_first->overlay_color = $colorsOverlay['black75'];
        $screen_impressionen_first->bg_img_cdn_link = $linkPicsum . "id/0/" . $imgWidth . "/" . $imgHeight . "?grayscale" . "." . $imgFileExt;
        $screen_impressionen_first->text_color = $colors['white'];
        $screen_impressionen_first->heading = "Impressionen";
        $screen_impressionen_first->subheading = 'Demo für das Projekt „Digital Signage“';
        $screen_impressionen_first->layout()->associate($basicLayout);
        $screen_impressionen_first->channel()->associate($channel_impressionen);
        $screen_impressionen_first->save();
        $screen_impressionen_first->replicate()->channel()->associate($channel_impressionen_admin)->push();

        for($loop=1; $loop <= 12; $loop++) {
            $padLoop = str_pad($loop, 2, '0', STR_PAD_LEFT);
            $screen_impressionen = new Screen();
            $screen_impressionen->name = "Impression " . $padLoop;
            $screen_impressionen->background_color = $colors['black'];
            $screen_impressionen->overlay_color = $colorsOverlay['black25'];
            $screen_impressionen->bg_img_cdn_link = $linkPicsum . "id/" . $loop . "/" . $imgWidth . "/" . $imgHeight . "." . $imgFileExt;
            $screen_impressionen->heading = 'Screen ' . $padLoop;
            $screen_impressionen->layout()->associate($basicLayout);
            $screen_impressionen->channel()->associate($channel_impressionen);
            $screen_impressionen->save();
            $screen_impressionen->replicate()->channel()->associate($channel_impressionen_admin)->push();
        }

        /*
         * CREATE CHANNEL "Projekt-VSPOT"
         */

        $channel_vspot = new Channel();
        $channel_vspot->name = "Projekt-VSPOT";
        $channel_vspot->description = "Zeigt Screens rund um das Projekt";
        $channel_vspot->user()->associate($superadmin);
        $channel_vspot->save();
        $channel_vspot_admin = $channel_vspot->replicate();
        $channel_vspot_admin->user()->associate($admin);
        $channel_vspot_admin->push();

        // Screens des Channels "Projekt-VSPOT"

        $screen_vspot_project_name_description = new Screen();
        $screen_vspot_project_name_description->name = "Projektname";
        $screen_vspot_project_name_description->description = "Zeigt zweizeilig Projektname und -beschreibung";
        $screen_vspot_project_name_description->background_color = $colors['black'];
        $screen_vspot_project_name_description->text_color = $colors['white'];
        $screen_vspot_project_name_description->heading = "Projekt VSPOT";
        $screen_vspot_project_name_description->subheading = 'Umsetzung eines Systems für digitale Beschilderung';
        $screen_vspot_project_name_description->layout()->associate($basicLayout);
        $screen_vspot_project_name_description->channel()->associate($channel_vspot);
        $screen_vspot_project_name_description->save();
        $screen_vspot_project_name_description->replicate()->channel()->associate($channel_vspot_admin)->push();

        $screen_vspot_authors = new Screen();
        $screen_vspot_authors->name = "Autoren";
        $screen_vspot_authors->description = "Zeigt die Autoren, Daniel Sixl und Stefan Süß";
        $screen_vspot_authors->background_color = $colors['primary'];
        $screen_vspot_authors->text_color = $colors['white'];
        $screen_vspot_authors->heading = "Autoren";
        $screen_vspot_authors->subheading = "Stefan Süß & Daniel Sixl";
        $screen_vspot_authors->layout()->associate($basicLayout);
        $screen_vspot_authors->channel()->associate($channel_vspot);
        $screen_vspot_authors->save();
        $screen_vspot_authors->replicate()->channel()->associate($channel_vspot_admin)->push();

        $screen_vspot_logo = new Screen();
        $screen_vspot_logo->name = "Logo";
        $screen_vspot_logo->description = "Zeigt das Logo in der Text-Variante";
        $screen_vspot_logo->bg_img_cdn_link = $linkCDN."v1572628911/vspot/vspot_screen_logo_text.png";
        $screen_vspot_logo->layout()->associate($basicLayout);
        $screen_vspot_logo->channel()->associate($channel_vspot);
        $screen_vspot_logo->save();
        $screen_vspot_logo->replicate()->channel()->associate($channel_vspot_admin)->push();

        $screen_vspot_schema_techstack_html = "<img src='".$linkCDN."v1572699638/vspot/vspot_schema_techstack.svg' alt='Schema Technologie'>";
        $screen_vspot_schema_techstack = new Screen();
        $screen_vspot_schema_techstack->name = "Schema Technologie";
        $screen_vspot_schema_techstack->description = "SVG mit den eingesetzten Lösungen des Projekts";
        $screen_vspot_schema_techstack->background_color = $colors['white'];
        $screen_vspot_schema_techstack->html_block = $screen_vspot_schema_techstack_html;
        $screen_vspot_schema_techstack->layout()->associate($htmlLayout);
        $screen_vspot_schema_techstack->channel()->associate($channel_vspot);
        $screen_vspot_schema_techstack->save();
        $screen_vspot_schema_techstack->replicate()->channel()->associate($channel_vspot_admin)->push();

        $screen_vspot_erm_html = "<img src='".$linkCDN."v1572701447/vspot/erm.svg' alt='Schema Datenbank'>";
        $screen_vspot_erm = new Screen();
        $screen_vspot_erm->name = "Schema Datenbank";
        $screen_vspot_erm->description = "SVG mit den eingesetzten Lösungen des Projekts";
        $screen_vspot_erm->background_color = $colors['white'];
        $screen_vspot_erm->html_block = $screen_vspot_erm_html;
        $screen_vspot_erm->layout()->associate($htmlLayout);
        $screen_vspot_erm->channel()->associate($channel_vspot);
        $screen_vspot_erm->save();
        $screen_vspot_erm->replicate()->channel()->associate($channel_vspot_admin)->push();

        $screen_vspot_invitation_html =
        "<h3>Projektvorstellung</h3>
        <h2><span class='w700'>VSPOT</span> <small class='w200'>Digital Signage Solution</small></h2>
        <h3 class='w400'>Stefan Süß und Daniel Sixl</h3>
        <p>Kommen Sie uns besuchen: <b style=\"background-color:rgb(199,0,56);\">Erdgeschoss / Zimmer 3</span></p>
        <blockquote><p>If debugging is the process of removing software bugs, then programming must be the process of putting them in.<br><small>— Edsger Dijkstra</small></p></blockquote>";
        $screen_vspot_invitation = new Screen();
        $screen_vspot_invitation->name = "Einladung";
        $screen_vspot_invitation->description = "Einladung zur Projektvorstellung";
        $screen_vspot_invitation->overlay_color = $colorsOverlay['black75'];
        $screen_vspot_invitation->bg_img_cdn_link = $linkPicsum . "id/2/" . $imgWidth . "/" . $imgHeight . "." . $imgFileExt;
        $screen_vspot_invitation->html_block = $screen_vspot_invitation_html;
        $screen_vspot_invitation->layout()->associate($htmlLayout);
        $screen_vspot_invitation->channel()->associate($channel_vspot);
        $screen_vspot_invitation->save();
        $screen_vspot_invitation->replicate()->channel()->associate($channel_vspot_admin)->push();

        /*
         * CREATE CHANNEL "Empfangsbereich"
         */

        $channel_reception = new Channel();
        $channel_reception->name = "Empfangsbereich";
        $channel_reception->description = "Zeigt beispielhaft Screens eines Empfangsbereichs";
        $channel_reception->user()->associate($superadmin);
        $channel_reception->save();
        $channel_reception_admin = $channel_reception->replicate();
        $channel_reception_admin->user()->associate($admin);
        $channel_reception_admin->push();

        // Screens des Channels "Empfangsbereich"

        $screen_reception_1_html =
        "<h3>Willkommen</h3>
        <h1>Herr Stefan Süß</h1>
        <p>Ihr Termin: <b style=\"background-color:rgb(107,165,74);\">Zimmer E03</b>, bei <span style=\"background-color:rgb(231,148,57);\">Herrn Sixl</span></p>
        <ul><li>08:00 - 09:30 Besprechung Projekt VSPOT</li><li>10:00 - 11:30 BarCamp Digital Signage</li></ul>";
        $screen_reception_1 = new Screen();
        $screen_reception_1->name = "Termin Süß";
        $screen_reception_1->description = "Termin mit Herrn Süß";
        $screen_reception_1->background_color = $colors['grey-nero'];
        $screen_reception_1->overlay_color = $colorsOverlay['black75'];
        $screen_reception_1->bg_img_cdn_link = $linkPicsum . "id/1037/" . $imgWidth . "/" . $imgHeight . "." . $imgFileExt;
        $screen_reception_1->text_color = $colors['white'];
        $screen_reception_1->html_block = $screen_reception_1_html;
        $screen_reception_1->layout()->associate($htmlLayout);
        $screen_reception_1->channel()->associate($channel_reception);
        $screen_reception_1->save();
        $screen_reception_1->replicate()->channel()->associate($channel_reception_admin)->push();

        $screen_reception_2_html =
        "<h3>Heute um 16:45 Uhr</h3>
        <h1>Live Coding Event</h1>
        <h2>mit Christian Schnagl</h2>
        <p>Kommen Sie uns besuchen: <b style=\"background-color:rgb(74,165,155);\">Halle 4 / Stand 37</span></p>
        <blockquote><p>Talk is cheap. Show me the code.<br><small>— Linus Torvalds</small></p></blockquote>";
        $screen_reception_2 = new Screen();
        $screen_reception_2->name = "Live Coding Event";
        $screen_reception_2->description = "Heute 12:00 Uhr, Zitat Linus";
        $screen_reception_2->background_color = $colors['grey-nero'];
        $screen_reception_2->overlay_color = $colorsOverlay['black75'];
        $screen_reception_2->bg_img_cdn_link = $linkPicsum . "id/1/" . $imgWidth . "/" . $imgHeight . "." . $imgFileExt;
        $screen_reception_2->text_color = $colors['white'];
        $screen_reception_2->html_block = $screen_reception_2_html;
        $screen_reception_2->layout()->associate($htmlLayout);
        $screen_reception_2->channel()->associate($channel_reception);
        $screen_reception_2->save();
        $screen_reception_2->replicate()->channel()->associate($channel_reception_admin)->push();

        /*
         * Initial device associations for superadmin
         */

        $deviceVSPOT1->channel()->associate($channel_impressionen)->save();
        $deviceVSPOT2->channel()->associate($channel_reception)->save();
        $deviceDemo->channel()->associate($channel_vspot)->save();

        /*
         * Initial device associations for admin
         */

        $deviceDemoAdmin->channel()->associate($channel_testing_admin)->save();

    }
}
