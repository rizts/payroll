<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $logged_in;

    function __construct() {
        parent::__construct();
        $this->logged_in = $this->session->userdata('logged_in_id');
        $this->load->model('User');
//        $this->output->enable_profiler(TRUE);
    }

    function sign_in() {
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
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-error">' . validation_errors() . '</div>');
            redirect('login');
        } else {
            # Periksa Login Untuk Administrator #
            if ($this->check_user($email, $password) == TRUE) {
                $userdata = array(
                    'username' => $email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($userdata);
                redirect('welcome');
            } else {
                # jika login username dan pass tidak sama #
                //$msg = '<div class="error_login"></div>';
                $msg = '<div class="alert alert-error">Periksa Username And Password!</div>';
                $this->session->set_flashdata('message', $msg);
                redirect('users/sign_in');
            }
        }
    }

    function check_user($email, $password) {
        $query = $this->db->get_where('staffs',
                        array(
                            'staff_email' => $email,
                            'staff_password' => md5($password))
                )->row();

        return $query;
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('users/sign_in');
    }

}

?>
