<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets extends CI_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('Asset');
        $this->load->model('Asset_Detail');
        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
// Create new User
        $a = new Asset();

// Enter values into required fields
//        $a->asset_name = "Table Office";
//        $a->asset_status = TRUE;
//        $a->date = "2013-09-09";
//        $a->staff_id = "1";
        $a->where('asset_name', 'Table Office')->get();

// Get country object for Australia
        $ad = new Asset_Detail();
        $ad->asset_id = $a->asset_id;
        $ad->date = '2013-09-09';
        $ad->descriptions = 'Description';
        $ad->assetd_status = 'Active';

// Save new user and also save a relationship to the country
        $ad->save();
    }

}