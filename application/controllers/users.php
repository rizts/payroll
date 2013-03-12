<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $logged_in;

    function __construct() {
        parent::__construct();
        $this->logged_in = $this->session->userdata('logged_in_id');
        $this->load->model('User');
        $this->output->enable_profiler(TRUE);
    }

    function sign_in() {
        $staff = new Staff();
        $query = $staff->get_where(
                        'staff_email', $this->input->post('email'),
                        'staff_password', md5($this->input->post('password'))
                )->row();

        $data['action'] = site_url('users/process_login');
        $data['email'] = array('name' => 'email',
            'placeholder' => 'Email',
            'class' => 'input-block-level'
        );
        $data['password'] = array('name' => 'password',
            'placeholder' => 'password',
            'class' => 'input-block-level'
        );
        $data['btn_sign_in'] = array('name' => 'btn_sign_in',
            'value' => 'Sign In',
            'class' => 'btn btn-primary btn-large'
        );

        $this->load->view('users/sign_in', $data);
    }

    function process_login() {
        $staff = new Staff();
        if ($staff->_login() == TRUE) {
            echo '<p>You have successfully logged in</p>';
        } else {
            echo '<p>please check your account</p>';
        }
    }

}

?>
