<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JsonDemoController extends Controller
{
    public function index () {

        date_default_timezone_set('UTC');

        $timestamp = Carbon::now()->timestamp;
        $officialDate = Carbon::now()->toRfc2822String();

        $dataArray = array (
            'user' => 'Stefan Süß',
            'userId' => 1,
            'presentationId' => 1,
            'timestamp' => $timestamp,
            'date' => $officialDate,
            'slides' =>
                array (
                    0 =>
                        array (
                            'number' => 1,
                            'slideType' => 'basic',
                            'backgroundImageUrl' => 'http://lorempixel.com/1600/900/technics/',
                            'content' => '<h1>Überschrift</h1><ul><li>Erster Punkt</li><li>Zweiter Punkt</li><li>Dritter Punkt</li></ul><p>Und ein kleiner Beispielsatz.</p>',
                            'color' =>
                                array (
                                    0 =>
                                        array (
                                            'hex' => '#ffffff',
                                        ),
                                    1 =>
                                        array (
                                            'rgb' => 'rgb(255, 255, 255)',
                                        ),
                                    2 =>
                                        array (
                                            'hsl' => 'hsl(0, 0%, 100%)',
                                        ),
                                    3 =>
                                        array (
                                            'rgba' =>
                                                array (
                                                    'r' => 255,
                                                    'g' => 255,
                                                    'b' => 255,
                                                    'a' => 0.9,
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'rgbaString' => 'rgba(255, 255, 255, 0.9)',
                                        ),
                                    5 =>
                                        array (
                                            'hex8String' => '#ffffffe5',
                                        ),
                                ),
                            'colorScheme' => 'light',
                        ),
                    1 =>
                        array (
                            'number' => 2,
                            'slideType' => 'basic',
                            'backgroundImageUrl' => 'http://lorempixel.com/1600/900/technics/2',
                            'content' => '<h1>Überschrift 2</h1><ul><li>Erster Punkt</li><li>Zweiter Punkt</li><li>Dritter Punkt</li></ul><p>Und ein kleiner Beispielsatz.</p>',
                            'color' =>
                                array (
                                    0 =>
                                        array (
                                            'hex' => '#e3ff8f',
                                        ),
                                    1 =>
                                        array (
                                            'rgb' => 'rgb(227, 255, 143)',
                                        ),
                                    2 =>
                                        array (
                                            'hsl' => 'hsl(75, 100%, 78%)',
                                        ),
                                    3 =>
                                        array (
                                            'rgba' =>
                                                array (
                                                    'r' => 227,
                                                    'g' => 255,
                                                    'b' => 143,
                                                    'a' => 0.9,
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'rgbaString' => 'rgba(227, 255, 143, 0.9)',
                                        ),
                                    5 =>
                                        array (
                                            'hex8String' => '#e3ff8fe5',
                                        ),
                                ),
                            'colorScheme' => 'light',
                        ),
                    2 =>
                        array (
                            'number' => 3,
                            'slideType' => 'basic',
                            'backgroundImageUrl' => 'http://lorempixel.com/1600/900/technics/3',
                            'content' => '<h1>Überschrift 3</h1><ul><li>Erster Punkt</li><li>Zweiter Punkt</li><li>Dritter Punkt</li></ul><p>Und ein kleiner Beispielsatz.</p>',
                            'color' =>
                                array (
                                    0 =>
                                        array (
                                            'hex' => '#ff031c',
                                        ),
                                    1 =>
                                        array (
                                            'rgb' => 'rgb(255, 3, 28)',
                                        ),
                                    2 =>
                                        array (
                                            'hsl' => 'hsl(354, 100%, 51%)',
                                        ),
                                    3 =>
                                        array (
                                            'rgba' =>
                                                array (
                                                    'r' => 255,
                                                    'g' => 3,
                                                    'b' => 28,
                                                    'a' => 0.9,
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'rgbaString' => 'rgba(255, 3, 28, 0.9)',
                                        ),
                                    5 =>
                                        array (
                                            'hex8String' => '#ff031ce5',
                                        ),
                                ),
                            'colorScheme' => 'light',
                        ),
                    3 =>
                        array (
                            'number' => 4,
                            'slideType' => 'basic',
                            'backgroundImageUrl' => 'http://lorempixel.com/1600/900/technics/3',
                            'content' => '<h1>Überschrift 3</h1><ul><li>Erster Punkt</li><li>Zweiter Punkt</li><li>Dritter Punkt</li></ul><p>Und ein kleiner Beispielsatz.</p>',
                            'color' =>
                                array (
                                    0 =>
                                        array (
                                            'hex' => '#ff031c',
                                        ),
                                    1 =>
                                        array (
                                            'rgb' => 'rgb(255, 3, 28)',
                                        ),
                                    2 =>
                                        array (
                                            'hsl' => 'hsl(354, 100%, 51%)',
                                        ),
                                    3 =>
                                        array (
                                            'rgba' =>
                                                array (
                                                    'r' => 255,
                                                    'g' => 3,
                                                    'b' => 28,
                                                    'a' => 0.9,
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'rgbaString' => 'rgba(255, 3, 28, 0.9)',
                                        ),
                                    5 =>
                                        array (
                                            'hex8String' => '#ff031ce5',
                                        ),
                                ),
                            'colorScheme' => 'dark',
                        ),
                    4 =>
                        array (
                            'number' => 5,
                            'slideType' => 'basic',
                            'backgroundImageUrl' => 'http://lorempixel.com/1600/900/technics/4',
                            'content' => '<h1>Überschrift 4</h1><ul><li>Erster Punkt</li><li>Zweiter Punkt</li><li>Dritter Punkt</li></ul><p>Und ein kleiner Beispielsatz.</p>',
                            'color' =>
                                array (
                                    0 =>
                                        array (
                                            'hex' => '#003cff',
                                        ),
                                    1 =>
                                        array (
                                            'rgb' => 'rgb(0, 60, 255)',
                                        ),
                                    2 =>
                                        array (
                                            'hsl' => 'hsl(226, 100%, 50%)',
                                        ),
                                    3 =>
                                        array (
                                            'rgba' =>
                                                array (
                                                    'r' => 0,
                                                    'g' => 60,
                                                    'b' => 255,
                                                    'a' => 0.63,
                                                ),
                                        ),
                                    4 =>
                                        array (
                                            'rgbaString' => 'rgba(0, 60, 255, 0.63)',
                                        ),
                                    5 =>
                                        array (
                                            'hex8String' => '#003cffa0',
                                        ),
                                ),
                            'colorScheme' => 'dark',
                        ),
                ),
        ) ;

        return response()->json($dataArray);
    }
}
