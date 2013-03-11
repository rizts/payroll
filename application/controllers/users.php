<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $logged_in;

    function __construct() {
        parent::__construct();
        $this->logged_in = $this->session->userdata('logged_in_id');
        $this->load->library('Login_Manager');
        $this->load->model('User');
//        $this->output->enable_profiler(TRUE);
//        $this->logged_in != '' ? redirect('users/sign_in') : redirect('welcome');
    }

    function sign_in() {

        $this->load->view('users/sign_in');
    }

    function process_login() {
        // Create a user to store the login validation
        $user = new User();
        if ($this->input->post('username') !== FALSE) {
            // A login was attempted, load the user data
            $user->from_array($_POST, array('username', 'password'));
            // get the result of the login request
            $login_redirect = $this->login_manager->process_login($user);
            if ($login_redirect) {
                if ($login_redirect === TRUE) {
                    // if the result was simply TRUE, redirect to the welcome page.
                    redirect('welcome');
                } else {
                    // otherwise, redirect to the stored page that was last accessed.
                    redirect($login_redirect);
                }
            }
        }
    }

    function sign_up() {
        $user = $this->login_manager->get_user();
        $this->load->view('users/sign_in');
    }

}

?>
