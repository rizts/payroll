<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $logged_in;

    function __construct() {
        parent::__construct();
        $this->logged_in = $this->session->userdata('logged_in_id');
        $this->load->model('User');
    }

    function sign_in() {
        $data['action'] = site_url('users/process_login');
        $data['username'] = array('name' => 'username',
            'placeholder' => 'username',
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
        $data['btn_add'] = anchor('users/sign_up/', 'Sign Up', array('class' => 'btn btn-large btn-info'));

        $this->load->view('users/sign_in', $data);
    }

    function process_login() {
        $u = new User();
        $u->username = $this->input->post('username');
        $u->password = $this->input->post('password');
        if ($u->login()) {
            echo '<p>Welcome ' . $this->username . '!</p>';
            echo '<p>You have successfully logged in</p>';
        } else {
            echo '<p>please check your account</p>';
        }
    }

    function sign_up() {
        $data['action'] = site_url('users/process_login');
        $data['first_name'] = array('name' => 'first_name',
            'placeholder' => 'First Name',
            'class' => 'input-block-level'
        );
        $data['last_name'] = array('name' => 'last_name',
            'placeholder' => 'Last Name',
            'class' => 'input-block-level'
        );
        $data['username'] = array('name' => 'username',
            'placeholder' => 'username',
            'class' => 'input-block-level'
        );
        $data['email'] = array('name' => 'email',
            'placeholder' => 'Email',
            'class' => 'input-block-level'
        );
        $data['password'] = array('name' => 'password',
            'placeholder' => 'password',
            'class' => 'input-block-level'
        );
        $data['confirm_password'] = array('name' => 'confirm_password',
            'placeholder' => 'Confirm password',
            'class' => 'input-block-level'
        );
        $data['btn_sign_up'] = array('name' => 'btn_sign_up',
            'value' => 'Sign Up',
            'class' => 'btn btn-primary btn-large'
        );
        $data['btn_add'] = anchor('users/sign_in/', 'Sign In', array('class' => 'btn btn-large btn-info'));

        $this->load->view('users/sign_up', $data);
    }

    function save() {
        $u = new User();
        $u->first_name = $this->input->post('first_name');
        $u->last_name = $this->input->post('last_name');
        $u->username = $this->input->post('username');
        $u->email = $this->input->post('email');
        $u->password = md5($this->input->post('password'));

        if ($u->save()) {
            $this->session->set_flashdata('message', 'User successfully created!');
            redirect('users/sign_in/');
        } else {
            $u->error_message('custom', 'Field required');
            $msg = $u->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('users/sign_up/');
        }
    }

}

?>
