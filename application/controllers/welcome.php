<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('Staff');
    }

    public function index() {
        $staff = new Staff();
        $data['staffs'] = $staff->get();
        $data['staff_count'] = $staff->count();
        $data['btn_new_staff'] = anchor('staffs/add', 'Add New Employee', array('class' => 'btn btn-block btn-primary'));
        $this->load->view('welcome_message', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */