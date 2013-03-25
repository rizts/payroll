<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('rupiah')) {

    function rupiah($var = '') {
        $x = number_format($var, 2, ".", ",");
        return $x;
    }

}
