<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;

class JsonDemoController extends Controller
{
    public function index () {

        $dataArray = array (
            'name' => 'Testing',
            'description' => 'Channel mit einigen einfachen Screens',
            'display_time' => 5000,
            'transition_time' => 1000,
            'refresh_time' => 5,
            'screens' =>
                array (
                    0 =>
                        array (
                            'background_color' => 'rgb(0,116,217)',
                            'bg_img_cdn_link' => NULL,
                            'overlay_color' => 'rgba(255,255,255,0)',
                            'text_color' => 'rgb(255, 255, 255)',
                            'heading' => 'Erster Screen',
                            'subheading' => NULL,
                            'text_block' => NULL,
                            'layout_name' => 'Basic',
                        ),
                    1 =>
                        array (
                            'background_color' => 'rgb(57,204,204)',
                            'bg_img_cdn_link' => NULL,
                            'overlay_color' => 'rgba(255,255,255,0)',
                            'text_color' => 'rgb(255, 255, 255)',
                            'heading' => 'Zweiter Screen',
                            'subheading' => 'Mit Unterüberschrift',
                            'text_block' => NULL,
                            'layout_name' => 'Basic',
                        ),
                    2 =>
                        array (
                            'background_color' => 'rgb(46,204,64)',
                            'bg_img_cdn_link' => NULL,
                            'overlay_color' => 'rgba(255,255,255,0)',
                            'text_color' => 'rgb(255, 255, 255)',
                            'heading' => 'Dritter Screen',
                            'subheading' => 'Mit Unterüberschrift',
                            'text_block' => NULL,
                            'layout_name' => 'Basic',
                        ),
                    3 =>
                        array (
                            'background_color' => 'rgba(255,220,0,1)',
                            'bg_img_cdn_link' => NULL,
                            'overlay_color' => 'rgba(255,255,255,0)',
                            'text_color' => 'rgb(0, 0, 0)',
                            'heading' => 'Vierter Screen',
                            'subheading' => 'Mit Unterüberschrift',
                            'text_block' => 'Zeile 1
Zeile 2
Zeile 3',
                            'layout_name' => 'Basic',
                        ),
                    4 =>
                        array (
                            'background_color' => 'rgb(177,13,201)',
                            'bg_img_cdn_link' => NULL,
                            'overlay_color' => 'rgba(255,255,255,0)',
                            'text_color' => 'rgb(255, 255, 255)',
                            'heading' => 'Fünfter Screen',
                            'subheading' => NULL,
                            'text_block' => NULL,
                            'layout_name' => 'Basic',
                        ),
                ),
        );

        return response()->json($dataArray);
    }
}
