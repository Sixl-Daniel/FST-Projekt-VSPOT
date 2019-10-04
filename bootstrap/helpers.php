<?php

// activeMenu

if (! function_exists('activeMenu')) {
    function activeMenu($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1).'/'.$uri.'/*') || Request::is(Request::segment(1).'/'.$uri) || Request::is($uri)) {
            $active = 'active';
        }

        return $active;
    }
}
