<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $logged_in;
    var $dir_path;
    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('User');
        $this->load->model('Staff');
        $this->dir_path = '/uploads/avatar/';
    }

    function index() {
        $user = new User();

        $data['title'] = "Users";
        $data['btn_add'] = anchor('users/sign_up', 'Add New', "class='btn btn-primary'");
        $data['btn_home'] = anchor(base_url(), 'Home', "class='btn btn-home'");

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        if ($this->input->get('search_by')) {
            $total_rows = $user->like($_GET['search_by'], $_GET['q'])->count();
            $user->like($_GET['search_by'], $_GET['q'])->order_by('username', 'ASC');
        } else {
            $total_rows = $user->count();
            $user->order_by('username', 'ASC');
        }


        $data['user_list'] = $user->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("users/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('users/index', $data);
    }

    function sign_in() {
        $data['action'] = site_url('users/process_login');
        $data['username'] = array('name' => 'username',
            'placeholder' => 'Username',
            'autofocus' => 'autofocus',
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

    function sign_up() {
        // Staffs
        $staff = new Staff();
        $list_staff = $staff->list_drop();
        $staff_selected = '';
        $data['form_action'] = '';
        $data['staff_id'] = form_dropdown('staff_id', $list_staff, $staff_selected);

        // Role
        $role = new Role();
        $list_role = $role->list_drop();
        $role_selected = '';
        $data['role_id'] = form_dropdown('role_id', $list_role, $role_selected);

        $data['username'] = array('name' => 'username',
            'placeholder' => 'Username',
            'class' => 'input-block-level'
        );
        $data['password'] = array('name' => 'password',
            'placeholder' => 'password',
            'class' => 'input-block-level'
        );
        $data['btn_sign_up'] = array('name' => 'btn_sign_up',
            'value' => 'Sign Up',
            'class' => 'btn btn-primary btn-large'
        );

        $this->load->view('users/sign_up', $data);
    }

    function process_login() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-error">' . validation_errors() . '</div>');
            redirect('users/sign_in');
        } else {
            if ($this->check_user($username, $password) == TRUE) {
                $user = new User();
                $rs = $user->where('username', $username)->get();
                $userdata = array(
                    'username' => $username,
                    'sess_role_id' => $rs->role_id,
                    'sess_staff_id' => $rs->staff_id,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($userdata);
                redirect('welcome');
            } else {
                $msg = '<div class="alert alert-error">Please check Username And Password!</div>';
                $this->session->set_flashdata('message', $msg);
                redirect('users/sign_in');
            }
        }
    }

    function check_user($username, $password) {
        $query = $this->db->get_where('users',
                        array(
                            'username' => $username,
                            'password' => md5($password))
                )->row();

        return $query;
    }

    function add_role() {
        $data['action'] = site_url('users/save_role');
        $data['role_name'] = array('name' => 'role_name');
        $data['btn_save'] = array('name' => 'btn_save',
            'value' => 'Save',
            'class' => 'btn btn-primary btn-large'
        );

        $this->load->view('users/add_role', $data);
    }

    function edit_role($id) {
        $role = new Role();
        $row = $role->where('role_id', $id)->get();
        $data['action'] = site_url('users/update_role/' . $id);
        $data['role_name'] = array('name' => 'role_name', 'value' => $row->role_name);
        $data['btn_save'] = array('name' => 'btn_save',
            'value' => 'Update',
            'class' => 'btn btn-primary btn-large'
        );

        $this->load->view('users/add_role', $data);
    }

    function update_role($id) {
        $role = new Role();
        $role->where('role_id', $id)
                ->update('role_name', $this->input->post('role_name'));

        $this->session->set_flashdata('message', 'Role Update successfuly.');
        redirect('users/roles');
    }

    function delete_role($id) {
        $role = new Role();
        $role->_delete($id);

        $this->session->set_flashdata('message', 'Role successfully deleted!');
        redirect('users/roles');
    }

    function save_role() {
        $role = new Role();
        $role->role_name = $this->input->post('role_name');
        if ($role->save()) {
            $this->session->set_flashdata('message', 'Role successfully created!');
            redirect('users/roles');
        } else {
            // Failed
            $role->error_message('custom', 'Role Name required');
            $msg = $role->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('users/add_role');
        }
    }

    function roles() {
        $role = new Role();
        $total_rows = $role->count();

        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "role_name";
                break;
            case "2":
                $data['col'] = "role_id";
                break;
            default:
                $data['col'] = "role_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $data['title'] = "Roles";
        $data['btn_add'] = anchor('users/add_role', 'Add New', "class='btn btn-primary'");
        $data['btn_home'] = anchor(base_url(), 'Home', "class='btn btn-home'");

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $role->order_by($data['col'], $data['dir']);

        $data['role_list'] = $role->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("users/roles");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('users/index_roles', $data);
    }

    function save_user() {
        $user = new User();
        $staff = new Staff();

        $user->staff_id = $this->input->post('staff_id');
        $user->role_id = $this->input->post('role_id');
        $user->username = $this->input->post('username');
        $user->password = md5($this->input->post('password'));
        $user->created_at = date('c');
        $user->updated_at = date('c');

        if ($user->save()) {
            /* Upload Images */
//            $staff->do_upload_fix($this->dir_path, $_FILES['file']);
            $this->session->set_flashdata('message', 'User successfuly save.');
            redirect('users/index');
        } else {
            // Failed
            $user->error_message('custom', 'Field required');
            $msg = $user->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('users/sign_up');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('users/sign_in');
    }

    function delete($id) {
        $user = new User();
        $user->_delete($id);
        redirect('users/index');
    }

    function to_excel() {
        $this->load->view('users/to_excel');
    }

}

?>
