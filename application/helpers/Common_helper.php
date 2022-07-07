<?php
if (!function_exists('create_folder')) {
    function create_folder($dir = '')
    {
        $result = true;

        if ($dir != '') {
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
        } else {
            $result = false;
        }

        return $result;
    }
}