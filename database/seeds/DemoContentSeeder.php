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

        // fetch user

        $superadmin = User::superadministrators()->first();

        // fetch layouts for screens

        $testLayout = Layout::whereName('Test')->first();
        $basicLayout = Layout::whereName('Basic')->first();
        $htmlLayout = Layout::whereName('HTML')->first();

        /*
         * CREATE DEVICES
         */

        $deviceVSPOT1 = new Device();
        $deviceVSPOT1->display_name = 'Monitor_Envy_27';
        $deviceVSPOT1->description = 'Monitor 27 Zoll, mit Raspberry Pi "VSPOT-1" in silbernem Gehäuse';
        $deviceVSPOT1->product_reference = 'HP Envy 27s';
        $deviceVSPOT1->location = 'Wohnzimmer';
        $deviceVSPOT1->user()->associate($superadmin);
        $deviceVSPOT1->save();

        $deviceVSPOT2 = new Device();
        $deviceVSPOT2->display_name = 'Presenter';
        $deviceVSPOT2->description = 'LCD-TV 50 Zoll, mit Raspberry Pi "VSPOT-2"';
        $deviceVSPOT2->product_reference = 'Toshiba 50L4333D';
        $deviceVSPOT2->location = 'Wohnzimmer';
        $deviceVSPOT2->user()->associate($superadmin);
        $deviceVSPOT2->save();

        $deviceDemo = new Device();
        $deviceDemo->display_name = 'Demo';
        $deviceDemo->description = 'Kein physikalisches Gerät, flexible Verwendung für Demos und Tests';
        $deviceDemo->user()->associate($superadmin);
        $deviceDemo->save();



        /*
         * CREATE CHANNEL "Information"
         */

        $channel_information = new Channel();
        $channel_information->name = "Information";
        $channel_information->description = "Ausgabe eines Testbildschirms mit Informationen";
        $channel_information->user()->associate($superadmin);
        $channel_information->save();

        // Screens des Channels "Information"

        $screen_information_1 = new Screen();
        $screen_information_1->name = "Information";
        $screen_information_1->description = "Anzeige des Test-Layouts mit Basisinformationen";
        $screen_information_1->background_color = "#000000";
        $screen_information_1->text_color = "#FAFAFA";
        $screen_information_1->layout()->associate($testLayout);
        $screen_information_1->channel()->associate($channel_information);
        $screen_information_1->save();



        /*
         * CREATE CHANNEL "Impressionen"
         */

        $channel_impressionen = new Channel();
        $channel_impressionen->name = "Impressionen";
        $channel_impressionen->description = "Eine Sammlung von Stimmungsbildern";
        $channel_impressionen->user()->associate($superadmin);
        $channel_impressionen->save();

        // Screens des Channels "Impressionen"

        $linkCdn = 'https://picsum.photos/';
        $imgWidth = 1600;
        $imgHeight = 900;
        $imgFileExt = "webp";

        $screen_impressionen_1 = new Screen();
        $screen_impressionen_1->name = "Impressionen-1";
        $screen_impressionen_1->background_color = "rgb(0,0,0)";
        $screen_impressionen_1->overlay_color = "rgba(0, 0, 0, 0.5)";
        $screen_impressionen_1->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?grayscale&random=1" . "." . $imgFileExt;
        $screen_impressionen_1->text_color = "rgb(255, 255, 255)";
        $screen_impressionen_1->heading = "Impressionen";
        $screen_impressionen_1->subheading = 'Demo für das Projekt „Digital Signage“';
        $screen_impressionen_1->layout()->associate($basicLayout);
        $screen_impressionen_1->channel()->associate($channel_impressionen);
        $screen_impressionen_1->save();

        $screen_impressionen_2 = new Screen();
        $screen_impressionen_2->name = "Impressionen-2";
        $screen_impressionen_2->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=2" . "." . $imgFileExt;
        $screen_impressionen_2->layout()->associate($basicLayout);
        $screen_impressionen_2->channel()->associate($channel_impressionen);
        $screen_impressionen_2->save();

        $screen_impressionen_3 = new Screen();
        $screen_impressionen_3->name = "Impressionen-3";
        $screen_impressionen_3->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=3" . "." . $imgFileExt;
        $screen_impressionen_3->layout()->associate($basicLayout);
        $screen_impressionen_3->channel()->associate($channel_impressionen);
        $screen_impressionen_3->save();

        $screen_impressionen_4 = new Screen();
        $screen_impressionen_4->name = "Impressionen-4";
        $screen_impressionen_4->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=4" . "." . $imgFileExt;
        $screen_impressionen_4->layout()->associate($basicLayout);
        $screen_impressionen_4->channel()->associate($channel_impressionen);
        $screen_impressionen_4->save();

        $screen_impressionen_5 = new Screen();
        $screen_impressionen_5->name = "Impressionen-5";
        $screen_impressionen_5->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=5" . "."  . $imgFileExt;
        $screen_impressionen_5->layout()->associate($basicLayout);
        $screen_impressionen_5->channel()->associate($channel_impressionen);
        $screen_impressionen_5->save();

        $screen_impressionen_6 = new Screen();
        $screen_impressionen_6->name = "Impressionen-6";
        $screen_impressionen_6->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=6" .".". $imgFileExt;
        $screen_impressionen_6->layout()->associate($basicLayout);
        $screen_impressionen_6->channel()->associate($channel_impressionen);
        $screen_impressionen_6->save();

        $screen_impressionen_7 = new Screen();
        $screen_impressionen_7->name = "Impressionen-7";
        $screen_impressionen_7->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=7" . "." . $imgFileExt;
        $screen_impressionen_7->layout()->associate($basicLayout);
        $screen_impressionen_7->channel()->associate($channel_impressionen);
        $screen_impressionen_7->save();

        $screen_impressionen_8 = new Screen();
        $screen_impressionen_8->name = "Impressionen-8";
        $screen_impressionen_8->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=8" . "." . $imgFileExt;
        $screen_impressionen_8->layout()->associate($basicLayout);
        $screen_impressionen_8->channel()->associate($channel_impressionen);
        $screen_impressionen_8->save();

        $screen_impressionen_9 = new Screen();
        $screen_impressionen_9->name = "Impressionen-9";
        $screen_impressionen_9->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=9" . "." . $imgFileExt;
        $screen_impressionen_9->layout()->associate($basicLayout);
        $screen_impressionen_9->channel()->associate($channel_impressionen);
        $screen_impressionen_9->save();

        $screen_impressionen_10 = new Screen();
        $screen_impressionen_10->name = "Impressionen-10";
        $screen_impressionen_10->background_color = "rgb(0,0,0)";
        $screen_impressionen_10->overlay_color = "rgba(0, 0, 0, 0.5)";
        $screen_impressionen_10->bg_img_cdn_link = $linkCdn . $imgWidth . "/" . $imgHeight . "?random=10" . "." . $imgFileExt;
        $screen_impressionen_10->layout()->associate($basicLayout);
        $screen_impressionen_10->channel()->associate($channel_impressionen);
        $screen_impressionen_10->save();



        /*
         * CREATE CHANNEL "Projekt-VSPOT"
         */

        $channel_vspot = new Channel();
        $channel_vspot->name = "Projekt-VSPOT";
        $channel_vspot->description = "Zeigt Screens rund um das Projekt";
        $channel_vspot->user()->associate($superadmin);
        $channel_vspot->save();

        // Screens des Channels "Projekt-VSPOT"

        $screen_vspot_2 = new Screen();
        $screen_vspot_2->name = "Projektname";
        $screen_vspot_2->description = "Zeigt zweizeilig Projektname und -beschreibung";
        $screen_vspot_2->background_color = "#000000";
        $screen_vspot_2->text_color = "#FFFFFF";
        $screen_vspot_2->heading = "Projekt VSPOT";
        $screen_vspot_2->subheading = 'Umsetzung eines Systems für digitale Beschilderung';
        $screen_vspot_2->layout()->associate($basicLayout);
        $screen_vspot_2->channel()->associate($channel_vspot);
        $screen_vspot_2->save();

        $screen_vspot_3 = new Screen();
        $screen_vspot_3->name = "Autoren";
        $screen_vspot_3->description = "Zeigt die Autoren, Daniel Sixl und Stefan Süß";
        $screen_vspot_3->background_color = "#C70038";
        $screen_vspot_3->text_color = "#FFFFFF";
        $screen_vspot_3->heading = "Autoren";
        $screen_vspot_3->subheading = "Stefan Süß & Daniel Sixl";
        $screen_vspot_3->layout()->associate($basicLayout);
        $screen_vspot_3->channel()->associate($channel_vspot);
        $screen_vspot_3->save();

        $screen_vspot_4 = new Screen();
        $screen_vspot_4->name = "Logo";
        $screen_vspot_4->description = "Zeigt das Logo in der Text-Variante";
        $screen_vspot_4->bg_img_cdn_link = "https://res.cloudinary.com/sixl/image/upload/v1572628911/vspot/vspot_screen_logo_text.png";
        $screen_vspot_4->layout()->associate($basicLayout);
        $screen_vspot_4->channel()->associate($channel_vspot);
        $screen_vspot_4->save();



        $screen_vspot_6_html =
        "
        <img src='https://res.cloudinary.com/sixl/image/upload/v1572699638/vspot/vspot_schema_techstack.svg' alt='Schema Technologie'>
        ";
        $screen_vspot_6 = new Screen();
        $screen_vspot_6->name = "Schema Technologie";
        $screen_vspot_6->description = "SVG mit den eingesetzten Lösungen des Projekts";
        $screen_vspot_6->background_color = "#FFFFFF";
        $screen_vspot_6->html_block = $screen_vspot_6_html;
        $screen_vspot_6->layout()->associate($htmlLayout);
        $screen_vspot_6->channel()->associate($channel_vspot);
        $screen_vspot_6->save();

        $screen_vspot_erm_html =
        "
        <img src='https://res.cloudinary.com/sixl/image/upload/v1572701447/vspot/erm.svg' alt='Schema Datanbank'>
        ";
        $screen_vspot_erm = new Screen();
        $screen_vspot_erm->name = "Schema Datanbank";
        $screen_vspot_erm->description = "SVG mit den eingesetzten Lösungen des Projekts";
        $screen_vspot_erm->background_color = "#FFFFFF";
        $screen_vspot_erm->html_block = $screen_vspot_erm_html;
        $screen_vspot_erm->layout()->associate($htmlLayout);
        $screen_vspot_erm->channel()->associate($channel_vspot);
        $screen_vspot_erm->save();


        $screen_vspot_invitation_html =
        "
        <h3>Projektvorstellung</h3>
        <h1><span class='w700'>VSPOT</span> <span class='w200'>Digital Signage Solution</span></h1>
        <hr>
        <h2>Stefan Süß und Daniel Sixl</h2>
        <p>Kommen Sie uns besuchen: <b style=\"background-color:#C70038;\">Erdgeschoss / Zimmer 3</span></p>
        <blockquote><p>If debugging is the process of removing software bugs, then programming must be the process of putting them in.<br><small>— Edsger Dijkstra</small></p></blockquote>
        ";
        $screen_vspot_invitation = new Screen();
        $screen_vspot_invitation->name = "Einladung";
        $screen_vspot_invitation->description = "Einladung zur Projektvorstellung";
        $screen_vspot_invitation->overlay_color = "rgba(17,17,17,0.80)";
        $screen_vspot_invitation->bg_img_cdn_link = "https://picsum.photos/id/2/3200/1800";
        $screen_vspot_invitation->html_block = $screen_vspot_invitation_html;
        $screen_vspot_invitation->layout()->associate($htmlLayout);
        $screen_vspot_invitation->channel()->associate($channel_vspot);
        $screen_vspot_invitation->save();


        /*
         * CREATE CHANNEL "Empfangsbereich"
         */

        $channel_reception = new Channel();
        $channel_reception->name = "Empfangsbereich";
        $channel_reception->description = "Zeigt beispielhaft Screens eines Empfangsbereichs";
        $channel_reception->user()->associate($superadmin);
        $channel_reception->save();

        // Screens des Channels "Empfangsbereich"

        $screen_reception_1_html =
        "
        <h3>Willkommen</h3>
        <h1>Herr Stefan Süß</h1>
        <p>Ihr Termin: <b style=\"background-color:rgb(107,165,74);\">Zimmer E03</b>, bei <span style=\"background-color:rgb(231,148,57);\">Herrn Sixl</span></p>
        <ul><li>08:00 - 09:30 Besprechung Projekt VSPOT</li><li>10:00 - 11:30 BarCamp Digital Signage</li></ul>
        ";
        $screen_reception_1 = new Screen();
        $screen_reception_1->name = "Termin Süß";
        $screen_reception_1->description = "Termin mit Herrn Süß";
        $screen_reception_1->background_color = "rgb(43,43,43)";
        $screen_reception_1->overlay_color = "rgba(17,17,17,0.83)";
        $screen_reception_1->bg_img_cdn_link = "https://picsum.photos/id/1037/1600/900";
        $screen_reception_1->text_color = "#FFFFFF";
        $screen_reception_1->html_block = $screen_reception_1_html;
        $screen_reception_1->layout()->associate($htmlLayout);
        $screen_reception_1->channel()->associate($channel_reception);
        $screen_reception_1->save();

        $screen_reception_2_html =
        "
        <h3>Heute um 16:45 Uhr</h3>
        <h1>Live Coding Event</h1>
        <h2>mit Christian Schnagl</h2>
        <p>Kommen Sie uns besuchen: <b style=\"background-color:rgb(74,165,155);\">Halle 4 / Stand 37</span></p>
        <blockquote><p>Talk is cheap. Show me the code.<br><small>— Linus Torvalds</small></p></blockquote>
        ";
        $screen_reception_2 = new Screen();
        $screen_reception_2->name = "Live Coding Event";
        $screen_reception_2->description = "Heute 12:00 Uhr, Zitat Linus";
        $screen_reception_2->background_color = "rgb(43,43,43)";
        $screen_reception_2->overlay_color = "rgba(17,17,17,0.83)";
        $screen_reception_2->bg_img_cdn_link = "https://picsum.photos/id/1/1600/900";
        $screen_reception_2->text_color = "#FFFFFF";
        $screen_reception_2->html_block = $screen_reception_2_html;
        $screen_reception_2->layout()->associate($htmlLayout);
        $screen_reception_2->channel()->associate($channel_reception);
        $screen_reception_2->save();


        /*
         * Initial device associations
         */

        $deviceVSPOT1->channel()->associate($channel_impressionen)->save();
        $deviceVSPOT2->channel()->associate($channel_reception)->save();
        $deviceDemo->channel()->associate($channel_vspot)->save();

    }
}
