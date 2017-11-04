<?php
/**
 * Created by PhpStorm.
 * User: Vanush
 * Date: 31.03.2017
 * Time: 8:46
 */

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        $class = '';

        if (request()->segment($segment) == $path[0]) {
            $class = ' active ';
        }

        return $class;
    }
}

?>