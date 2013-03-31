<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('bulan')) {

    function bulan($bln) {
        $x= explode("-", $bln); 
        $thn = $x[0];
        $bln = $x[1];
        switch ($bln) {
            case "01":
                return "Jan";
                break;
            case "02":
                return "Feb";
                break;
            case "03":
                return "Mar";
                break;
            case "04":
                return "Apr";
                break;
            case "05":
                return "Mei";
                break;
            case "06":
                return "Jun";
                break;
            case "07":
                return "Jul";
                break;
            case "08":
                return "Ags";
                break;
            case "09":
                return "Sep";
                break;
            case "10":
                return "Okt";
                break;
            case "11":
                return "Nov";
                break;
            case "12":
                return "Des";
                break;
        }
    }

}